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
     * @param $key
     *
     * @return mixed|null
     */
    public function getFromBody($key)
    {
        return isset($this->body[$key]) ? $this->body[$key] : null;
    }

    /**
     * @param array $values
     * @param scalar $value
     *
     * @throws RuntimeException
     *
     * @return void
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
     * @return array|Response
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
        if($result) {
            return new Response($this->body, json_decode($result, true));
        }

        return array(
            'result'       => $result,
            'error'        => curl_error($ch),
            'body'         => $this->body,
            'request_info' => curl_getinfo($ch),
        );
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
}