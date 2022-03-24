<?php

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
     * @return \sUseDeskRequestUpdateClient
     */
    public function setClientId($id)
    {
        return $this->setBody('client_id', $id);
    }
}