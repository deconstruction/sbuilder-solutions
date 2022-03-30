<?php

namespace UseDesk\Requests;

use RuntimeException;
use UseDesk\Client;
use UseDesk\Response;

/**
 * Класс для создания запроса API
 */
class Request
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $body = array();

    /**
     * @param Client $client
     * @param string $method
     */
    public function __construct($client, $method)
    {
        $this->method = $method;
        $this->client = $client;

        $this->body['api_token'] = $client->token;
    }

    /**
     * Обновляем значение в теле запроса
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    protected function setBody($key, $value)
    {
        $this->body[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public function getFromBody($key, $default = null)
    {
        return isset($this->body[$key]) ? $this->body[$key] : $default;
    }

    /**
     * @param array  $values
     * @param scalar $value
     *
     * @return void
     * @throws RuntimeException
     *
     */
    protected function checkValue($values, $value)
    {
        if(!in_array($value, $values, true)) {
            throw new RuntimeException('Неверное значение для поля type. Возможные значения: ' . implode(', ', $values));
        }
    }

    /**
     * Отправляем запрос
     *
     * @return Response
     */
    public function push()
    {
        $this->preparePush();

        $ch = curl_init($this->client->url . $this->method);

        $curlOptions = array(
            CURLOPT_USERAGENT      => 'PHP-MCAPI/2.0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $this->body,
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: multipart/form-data',
            ),
        );

        curl_setopt_array($ch, $curlOptions);

        $result = curl_exec($ch);

        if(!$result) {
            $result = array(
                'error'        => curl_error($ch),
                'request_info' => curl_getinfo($ch),
            );
        }

        $result   = is_array($result) ? $result : json_decode($result, true);
        $response = new Response($this->body, $result);

        $this->logged(curl_getinfo($ch), $response);

        return $response;
    }

    /**
     * Получит массив запроса
     *
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return void
     */
    protected function preparePush()
    {
    }

    /**
     * @param array    $curl
     * @param Response $response
     *
     * @return void
     */
    private function logged($curl, $response)
    {
        $dirTree = array(
            'logs',
            $response->hasErrors() ? 'errors' : 'success',
            date('Y/m/d'),
        );

        $method = str_replace('/', '-', $this->method);
        if($response->hasErrors()) {
            $dirTree[] = session_id();
            $dirTree[] = time();
            $dirTree[] = $method;
        } else {
            $dirTree[] = $method;

            $dirTree[] = $response->get('ticket_id', time() . '' . mt_rand(1, 9999999));
        }

        $dir = implode('/', $dirTree);

        if(file_exists($dir) || mkdir($dir, 0755, true) || is_dir($dir)) {
            file_put_contents("$dir/body.json", $response->toJson($response->getBody()));
            file_put_contents("$dir/response.json", $response->toJson($response->getResponse()));
            file_put_contents("$dir/curl.json", json_encode($curl));
        }
    }
}