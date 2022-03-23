<?php

class sUseDeskRequest
{
    /**
     * @var \sUseDeskClient
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
     * @param \sUseDeskClient $client
     * @param string          $method
     */
    public function __construct($client, $method)
    {
        $this->method = $method;
        $this->client = $client;

        $this->body['api_token'] = $client->token;
    }

    /**
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
     * @param $values
     * @param $value
     *
     * @return void
     */
    protected function checkValue($values, $value)
    {
        if(!in_array($value, $values, true)) {
            throw new \RuntimeException('Неверное значение для поля type. Возможные значения: ' . implode(', ', $values));
        }
    }

    /**
     * @return array|\sUseDeskResponse
     */
    public function push()
    {
        $ch = curl_init($this->client->url . $this->method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);

        $result = curl_exec($ch);
        if($result) {
            return new sUseDeskResponse($this->body, json_decode($result, true));
        }

        return array(
            'result'       => $result,
            'error'        => curl_error($ch),
            'body'         => $this->body,
            'request_info' => curl_getinfo($ch),
        );
    }
}