<?php

namespace UseDesk;

use UseDesk\Requests\Ticket\tokioCityRequestCreateTicket;

class UseDeskTokioCity
{
    private $request;

    public function __construct()
    {
        $client        = new tokioCityClient();
        $this->request = $client->createTicket();
    }

    /**
     * @return tokioCityRequestCreateTicket
     */
    public function getRequest()
    {
        return $this->request;
    }
}