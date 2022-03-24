<?php

namespace UseDesk\Requests\Clients;

use UseDesk\Requests\sUseDeskRequest;

/**
 * Метод создает нового клиента
 */
class sUseDeskRequestUpdateClient extends sUseDeskRequestCreateClient
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