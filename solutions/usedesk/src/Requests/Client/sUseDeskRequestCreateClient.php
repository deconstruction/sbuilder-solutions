<?php

/**
 * Метод создает нового клиента
 */
class sUseDeskRequestCreateClient extends sUseDeskRequest
{
    /**
     * Новое имя клиента
     *
     * @param $value
     *
     * @return \sUseDeskRequestCreateClient
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
     * @return \sUseDeskRequestCreateClient
     */
    public function setEmails($value)
    {
        if(is_scalar($value)) {
            $value = explode(',', $value);
            $value = array_map('trim', $value);
            $value = json_encode($value);
        }

        return $this->setBody('emails', $value);
    }

    /**
     * Массив с данными мессенджеров
     *
     * @param $value
     *
     * @return \sUseDeskRequestCreateClient
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
     * @return \sUseDeskRequestCreateClient
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
     * @return \sUseDeskRequestCreateClient
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
     * @return \sUseDeskRequestCreateClient
     */
    public function setMergeId($value)
    {
        return $this->setBody('merge_id', $value);
    }
}