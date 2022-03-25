<?php

namespace UseDesk\Cases\TokioCity;

/**
 * Кейс для создания запроса Tokio City
 */
class UseDeskTokioCity
{
    private $request;

    /**
     * @var \UseDesk\Cases\TokioCity\Client
     */
    private $client;

    public $from = 'tokio-city.ru';

    public function __construct()
    {
        $this->client  = new Client();
        $this->request = $this->client->createTicket();
    }

    /**
     * @return \UseDesk\Cases\TokioCity\Requests\Ticket\RequestCreateTicket
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * @return \UseDesk\Cases\TokioCity\Client
     */
    public function client()
    {
        return $this->client;
    }
}