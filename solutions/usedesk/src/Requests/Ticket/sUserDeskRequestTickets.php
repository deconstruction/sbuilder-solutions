<?php

/**
 * Метод возвращает тикеты, удовлетворяющих заданным условиям фильтров.
 * В методе реализована постраничная разбивка. В ответе максимум 100 записей, для смещения используется параметр offset.
 *
 * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA%D1%82%D0%B8%D0%BA%D0%B5%D1%82%D0%BE%D0%B2
 */
class sUserDeskRequestTickets extends sUseDeskRequest
{
    /**
     * @param $value
     *
     * @return self
     */
    public function setChannel($value)
    {
        return $this->setBody('fchannel', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setGroup($value)
    {
        return $this->setBody('fgroup', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setStatus($value)
    {
        return $this->setBody('fstatus', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setType($value)
    {
        return $this->setBody('ftype', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setPriority($value)
    {
        return $this->setBody('fpriority', $value);
    }

    /**
     * @param int $value
     *
     * @return self
     */
    public function setAccessibleForAgentId($value)
    {
        return $this->setBody('accessible_for_agent_id', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setOffset($value)
    {
        return $this->setBody('offset', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setTag($value)
    {
        return $this->setBody('tag', $value);
    }

    /**
     * В выдачу попадут сущности, созданные после указанной даты (включительно)
     * Пример использования:
     * 2022-01-01 00:00
     *
     * @param $value
     *
     * @return self
     */
    public function setCreatedAfter($value)
    {
        return $this->setBody('created_after', $value);
    }

    /**
     * В выдачу попадут сущности, созданные до указанной даты (включительно)
     * Пример использования:
     * 2022-12-31 23:59
     *
     * @param $value
     *
     * @return self
     */
    public function setCreatedBefore($value)
    {
        return $this->setBody('created_before', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setUpdatedAfter($value)
    {
        return $this->setBody('updated_after', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setUpdatedBefore($value)
    {
        return $this->setBody('updated_before', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setQuery($value)
    {
        return $this->setBody('query', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setClientId($value)
    {
        return $this->setBody('client_id', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setFields($value)
    {
        return $this->setBody('fields', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
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

    /**
     * @param $value
     *
     * @return self
     */
    public function setOrder($value)
    {
        $values = array(
            'asc',
            'desc'
        );
        $this->checkValue($values, $value);

        return $this->setBody('order', $value);
    }
}