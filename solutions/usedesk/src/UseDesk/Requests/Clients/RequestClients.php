<?php

namespace UseDesk\Requests\Clients;

use UseDesk\Requests\Request;

/**
 * Класс возвращает тикеты, удовлетворяющих заданным условиям фильтров.
 * В методе реализована постраничная разбивка. В ответе максимум 100 записей, для смещения используется параметр offset.
 */
class RequestClients extends Request
{
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
    public function setOffset($value)
    {
        return $this->setBody('offset', $value);
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
     * @param string $value
     *
     * @throws \RuntimeException
     *
     * @return $this
     */
    public function setSearchType($value)
    {
        $values = array(
            'partial_match',
            'full_match'
        );

        $this->checkValue($values, $value);

        return $this;
    }

    /**
     * @throws \RuntimeException
     *
     * @return $this
     */
    public function setSearchTypePartialMatch()
    {
        return $this->setSearchType('partial_match');
    }

    /**
     * @throws \RuntimeException
     *
     * @return $this
     */
    public function setSearchTypeFullMatch()
    {
        return $this->setSearchType('full_match');
    }
}