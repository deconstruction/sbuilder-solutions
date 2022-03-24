<?php

namespace UseDesk;

use UseDesk\Requests\Clients\RequestClient;
use UseDesk\Requests\Clients\RequestClients;
use UseDesk\Requests\Clients\RequestCreateClient;
use UseDesk\Requests\Clients\RequestUpdateClient;
use UseDesk\Requests\Fields\RequestFields;
use UseDesk\Requests\Request;
use UseDesk\Requests\Tickets\RequestCreateTicket;
use UseDesk\Requests\Tickets\RequestTicket;
use UseDesk\Requests\Tickets\RequestTickets;

/**
 * Для старта работы с API клиентом необходимо создать экземпляр данного класса
 */
class Client
{
    const METHOD_TICKET_FIELDS = 'ticket/fields';

    const METHOD_TICKET_CREATE = 'create/ticket';

    const METHOD_TICKET = 'ticket';

    const METHOD_TICKETS = 'tickets';

    const METHOD_CLIENT_CREATE = 'create/client';

    const METHOD_CLIENT_UPDATE = 'update/client';

    const METHOD_CLIENT = 'client';

    const METHOD_CLIENTS = 'clients';

    /**
     * API Token
     *
     * @var string
     */
    public $token = 'ebc4657de935708816c65dd66834140a72338cbf';

    /**
     * API URL
     *
     * @var string
     */
    public $url = 'https://api.usedesk.ru/';

    /**
     * Список тикетов
     *
     * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA%D1%82%D0%B8%D0%BA%D0%B5%D1%82%D0%BE%D0%B2
     *
     * @return RequestTickets
     */
    public function tickets()
    {
        return new RequestTickets($this, self::METHOD_TICKETS);
    }

    /**
     * Отдельный тикет
     *
     * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%9E%D1%82%D0%B4%D0%B5%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%D1%82%D0%B8%D0%BA%D0%B5%D1%82
     *
     * @return RequestTicket
     */
    public function ticket($ticketId)
    {
        $ticket = new RequestTicket($this, self::METHOD_TICKET);

        return $ticket->setId($ticketId);
    }

    /**
     * Создать тикет
     *
     * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/219611150#id-%D0%A2%D0%B8%D0%BA%D0%B5%D1%82%D1%8B-%D0%A1%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C%D1%82%D0%B8%D0%BA%D0%B5%D1%82
     *
     * @return RequestCreateTicket
     */
    public function createTicket()
    {
        return new RequestCreateTicket($this, self::METHOD_TICKET_CREATE);
    }

    /**
     * Получить список клиентов
     *
     * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/292028464#id-%D0%9A%D0%BB%D0%B8%D0%B5%D0%BD%D1%82%D1%8B-%D0%9F%D0%BE%D0%BB%D1%83%D1%87%D0%B8%D1%82%D1%8C%D1%81%D0%BF%D0%B8%D1%81%D0%BE%D0%BA%D0%BA%D0%BB%D0%B8%D0%B5%D0%BD%D1%82%D0%BE%D0%B2
     *
     * @return RequestClients
     */
    public function clients()
    {
        return new RequestClients($this, self::METHOD_CLIENTS);
    }

    /**
     * @param int $id
     *
     * @return RequestClient
     *@link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/292028464#id-%D0%9A%D0%BB%D0%B8%D0%B5%D0%BD%D1%82%D1%8B-%D0%9E%D1%82%D0%B4%D0%B5%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%D0%BA%D0%BB%D0%B8%D0%B5%D0%BD%D1%82
     *
     */
    public function client($id)
    {
        $request = new RequestClient($this, self::METHOD_CLIENT);

        return $request->setClientId($id);
    }

    /**
     * Метод создает нового клиента
     *
     * @link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/292028464#id-%D0%9A%D0%BB%D0%B8%D0%B5%D0%BD%D1%82%D1%8B-%D0%A1%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C%D0%BA%D0%BB%D0%B8%D0%B5%D0%BD%D1%82%D0%B0
     *
     * @return RequestCreateClient
     */
    public function createClient()
    {
        return new RequestCreateClient($this, self::METHOD_CLIENT_CREATE);
    }

    /**
     * @param $id
     *
     * @return RequestUpdateClient
     *@link https://usedeskkb.atlassian.net/wiki/spaces/API/pages/292028464#id-%D0%9A%D0%BB%D0%B8%D0%B5%D0%BD%D1%82%D1%8B-%D0%9E%D0%B1%D0%BD%D0%BE%D0%B2%D0%B8%D1%82%D1%8C%D0%BA%D0%BB%D0%B8%D0%B5%D0%BD%D1%82%D0%B0
     *
     */
    public function updateClient($id)
    {
        $request = new RequestUpdateClient($this, self::METHOD_CLIENT_UPDATE);

        return $request->setClientId($id);
    }

    public function fields()
    {
        return new RequestFields($this, self::METHOD_TICKET_FIELDS);
    }

    /**
     * @param $method
     *
     * @return Request
     */
    public function method($method)
    {
        return new Request($this, $method);
    }
}