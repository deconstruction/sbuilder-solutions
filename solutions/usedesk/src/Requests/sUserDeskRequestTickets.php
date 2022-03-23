<?php

class sUserDeskRequestTickets extends sUseDeskRequest
{
    public function setId($value)
    {
        return $this->setBody('ticket_id', $value);
    }

    public function setChannel($value)
    {
        return $this->setBody('fchannel', $value);
    }

    public function setGroup($value)
    {
        return $this->setBody('fgroup', $value);
    }

    public function setStatus($value)
    {
        return $this->setBody('fstatus', $value);
    }

    public function setType($value)
    {
        return $this->setBody('ftype', $value);
    }

    public function setPriority($value)
    {
        return $this->setBody('fpriority', $value);
    }

    public function setAccessibleForAgentId($value)
    {
        return $this->setBody('accessible_for_agent_id', $value);
    }

    public function setOffset($value)
    {
        return $this->setBody('offset', $value);
    }

    public function setTag($value)
    {
        return $this->setBody('tag', $value);
    }

    public function setCreatedAfter($value)
    {
        return $this->setBody('created_after', $value);
    }

    public function setCreatedBefore($value)
    {
        return $this->setBody('created_before', $value);
    }

    public function setUpdatedAfter($value)
    {
        return $this->setBody('updated_after', $value);
    }

    public function setUpdatedBefore($value)
    {
        return $this->setBody('updated_before', $value);
    }

    public function setQuery($value)
    {
        return $this->setBody('query', $value);
    }

    public function setClientId($value)
    {
        return $this->setBody('client_id', $value);
    }

    public function setFields($value)
    {
        return $this->setBody('fields', $value);
    }

    public function setSort($value)
    {
        $values = array(
            'id',
            'status_id',
            'client_id',
            'assignee_id',
            'group',
            'last_updated_at',
            'published_at'
        );
        $this->checkValue($value, $value);

        return $this->setBody('order', $value);
    }

    public function setOrder($value)
    {
        $values = array(
            'asc',
            'desc'
        );
        $this->checkValue($value, $value);

        return $this->setBody('order', $value);
    }
}