<?php

class sUseDeskTokioCityClient extends sUseDeskClient
{
    /**
     * Создать тикет
     *
     * @return \sUseDeskTokioCityRequestCreateTicket
     */
    public function createTicket()
    {
        return new sUseDeskTokioCityRequestCreateTicket($this, self::METHOD_TICKET_CREATE);
    }
}