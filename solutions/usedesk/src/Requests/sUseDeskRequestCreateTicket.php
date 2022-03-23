<?php

/**
 * Класс создает тикет для API канала.
 *
 * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%A1%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C%D1%82%D0%B8%D0%BA%D0%B5%D1%82
 */
class sUseDeskRequestCreateTicket extends sUseDeskRequest
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function setSubject($value)
    {
        $this->body['subject'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setMessage($value)
    {
        $this->body['message'] = $value;

        return $this;
    }

    public function setClientEmail($value)
    {
        $this->body['client_email'] = $value;

        return $this;
    }

    public function setClientId($value = 'new_client')
    {
        $this->body['client_id'] = $value;

        return $this;
    }

    public function setCompanyName($value)
    {
        $this->body['company_name'] = $value;

        return $this;
    }

    public function createPrivateComment()
    {
        $this->body['private_comment'] = true;

        return $this;
    }

    public function setAdditionalId($value)
    {
        $this->body['additional_id'] = $value;

        return $this;
    }

    public function setType($value)
    {
        $types = array(
            'question',
            'task',
            'problem',
            'incident',
        );
        $this->checkValue($types, $value);

        $this->body['type'] = $value;

        return $this;
    }
}