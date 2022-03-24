<?php

namespace UseDesk;

use UseDesk\Requests\Ticket\tokioCityRequestCreateTicket;

class tokioCityClient extends Client
{
    /**
     * Создать тикет
     *
     * @return tokioCityRequestCreateTicket
     */
    public function createTicket()
    {
        return new tokioCityRequestCreateTicket($this, self::METHOD_TICKET_CREATE);
    }
}