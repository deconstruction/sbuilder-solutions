<?php

namespace UseDesk\Requests\Clients;

use UseDesk\Requests\Request;

/**
 * Метод создает нового клиента
 */
class RequestCreateClient extends Request
{
    /**
     * Новое имя клиента
     *
     * @param $value
     *
     * @return self
     */
    public function setName($value)
    {
        return $this->setBody('name', $value);
    }

    /**
     * Массив с почтовыми адресами
     *
     * @param $value
     *
     * @return self
     */
    public function setEmails($value)
    {
        if(is_scalar($value)) {
            $value = explode(',', $value);
            $value = array_map('trim', $value);
        }

        return $this->setBody('emails', $value);
    }

    /**
     * Массив с данными мессенджеров
     *
     * @param $value
     *
     * @return self
     */
    public function setMessengers($value)
    {
        return $this->setBody('messengers', $value);
    }

    /**
     * Текст заметки
     *
     * @param $value
     *
     * @return self
     */
    public function setNote($value)
    {
        return $this->setBody('note', $value);
    }

    /**
     * Телефон пользователя
     *
     * @param $value
     *
     * @return self
     */
    public function setPhone($value)
    {
        return $this->setBody('phone', $value);
    }

    /**
     * Идентификатор клиента, с которым будет объединен пользователь с идентификатором client_id
     *
     * @param $value
     *
     * @return self
     */
    public function setMergeId($value)
    {
        return $this->setBody('merge_id', $value);
    }
}