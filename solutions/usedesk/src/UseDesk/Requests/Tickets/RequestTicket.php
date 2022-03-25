<?php

namespace UseDesk\Requests\Tickets;

use UseDesk\Requests\Request;

/**
 * Метод возвращает тикет по-указанному id. Принимает один id тикета.
 *
 * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%9E%D1%82%D0%B4%D0%B5%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%D1%82%D0%B8%D0%BA%D0%B5%D1%82
 */
class RequestTicket extends Request
{
    /**
     * @param $value
     *
     * @return self
     */
    public function setId($value)
    {
        return $this->setBody('ticket_id', $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setProperties($value)
    {
        return $this->setBody('properties', $value);
    }
}