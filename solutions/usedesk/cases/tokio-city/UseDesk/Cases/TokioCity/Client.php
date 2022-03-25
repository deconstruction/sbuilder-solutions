<?php

namespace UseDesk\Cases\TokioCity;

use UseDesk\Cases\TokioCity\Requests\Tickets\RequestCreateTicket;

class Client extends \UseDesk\Client
{
    public function createTicket()
    {
        return new RequestCreateTicket($this, self::METHOD_TICKET_CREATE);
    }
}