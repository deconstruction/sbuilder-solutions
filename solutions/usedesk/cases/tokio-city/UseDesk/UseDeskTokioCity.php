<?php

namespace UseDesk;

use UseDesk\Requests\Ticket\sUseDeskTokioCityRequestCreateTicket;

class UseDeskTokioCity
{
    private $request;

    public function __construct()
    {
        $client        = new sUseDeskTokioCityClient();
        $this->request = $client->createTicket();
    }

    /**
     * @return sUseDeskTokioCityRequestCreateTicket
     */
    public function getRequest()
    {
        return $this->request;
    }
}