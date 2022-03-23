<?php

class sUseDeskResponse
{
    /**
     * @var array
     */
    private $body;

    /**
     * @var array
     */
    private $response;

    /**
     * @param array $body
     * @param array $response
     */
    public function __construct($body, $response)
    {
        $this->body = $body;
        $this->response = $response;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return isset($this->response['error']);
    }

    public function getErrorMessage()
    {
        if($this->hasErrors()) {
            return $this->response['error'];
        }

        return null;
    }
}