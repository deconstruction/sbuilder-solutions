<?php

namespace UseDesk\Requests\Clients;

use UseDesk\Requests\sUseDeskRequest;

/**
 * Метод возвращает информацию об указанном клиенте компании. Принимает один id клиента
 */
class sUseDeskRequestClient extends sUseDeskRequest
{
    /**
     * @param int $value
     *
     * @return self
     */
    public function setClientId($value)
    {
        return $this->setBody('client_id', $value);
    }
}