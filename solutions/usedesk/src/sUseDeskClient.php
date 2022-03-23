<?php

class sUseDeskClient
{
    public $token = 'ebc4657de935708816c65dd66834140a72338cbf';

    public $url = 'https://api.usedesk.ru/';

    /**
     * @return \sUseDeskRequest
     */
    public function createTicket()
    {
        return new sUseDeskRequestCreateTicket($this, 'create/ticket');
    }

    /**
     * @return \sUserDeskRequestTickets
     */
    public function tickets()
    {
        return new sUserDeskRequestTickets($this, 'tickets');
    }

    /**
     * @param string $method
     *
     * @return \sUseDeskRequest
     */
    public function method($method)
    {
        return new sUseDeskRequest($this, $method);
    }
}