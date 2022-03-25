<?php

namespace UseDesk\Cases\TokioCity;

/**
 * Кейс для создания запроса Tokio City
 */
class UseDeskTokioCity
{
    private $request;

    public function __construct()
    {
        $client        = new Client();
        $this->request = $client->createTicket();
    }

    /**
     * @return \UseDesk\Cases\TokioCity\Requests\Ticket\RequestCreateTicket
     */
    public function request()
    {
        return $this->request;
    }
}