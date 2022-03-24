<?php

namespace UseDesk\Requests\Clients;

/**
 * Метод создает нового клиента
 */
class RequestUpdateClient extends RequestCreateClient
{
    /**
     * id клиента
     *
     * @param int $id
     *
     * @return self
     */
    public function setClientId($id)
    {
        return $this->setBody('client_id', $id);
    }
}