<?php

namespace UseDesk\Requests\Clients;

use UseDesk\Requests\Request;

/**
 * Метод возвращает информацию об указанном клиенте компании. Принимает один id клиента
 */
class RequestClient extends Request
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