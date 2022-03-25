<?php

namespace UseDesk\Cases\TokioCity;

use UseDesk\Cases\TokioCity\Requests\Ticket\RequestCreateTicket;
use UseDesk\Client as BaseClient;

class Client extends BaseClient
{
    public function createTicket()
    {
        return new RequestCreateTicket($this, self::METHOD_TICKET_CREATE);
    }
}