<?php

namespace UseDesk\Requests\Ticket;

use UseDesk\Requests\Tickets\RequestCreateTicket;

class tokioCityRequestCreateTicket extends RequestCreateTicket
{
    const FIELD_ID_RESTAURANT           = 18617;

    const FIELD_ID_DATE_VISIT           = 18617;

    const FIELD_ID_ORDER_ID             = 18613;

    const FIELD_ID_DIRECTION            = 18622;

    const FIELD_ID_ORDER_TYPE           = 18637;

    const FIELD_ID_INITIATOR            = 18638;

    const FIELD_ID_SOURCE_APPEAL        = 18639;

    const FIELD_ID_DISCOUNT_CARD_NUMBER = 18640;

    public function __construct($client, $method)
    {
        parent::__construct($client, $method);

        // SetUp Start Fields
        $this
            ->setFieldDirection(78606)
            ->setFieldTypeOrder(78849)
            ->setFieldInitiator(78851)
            ->setFieldSourceAppeal(78866);
    }

    public function setFieldRestaurantId($value)
    {
        return $this->addField(self::FIELD_ID_RESTAURANT, $value);
    }

    public function setFieldDateVisit($value)
    {
        return $this->addField(self::FIELD_ID_DATE_VISIT, $value);
    }

    public function setFieldOrderId($value)
    {
        return $this->addField(self::FIELD_ID_ORDER_ID, $value);
    }

    public function setFieldDirection($value)
    {
        return $this->addField(self::FIELD_ID_DIRECTION, $value);
    }

    public function setFieldTypeOrder($value)
    {
        return $this->addField(self::FIELD_ID_ORDER_TYPE, $value);
    }

    public function setFieldInitiator($value)
    {
        return $this->addField(self::FIELD_ID_INITIATOR, $value);
    }

    public function setFieldSourceAppeal($value)
    {
        return $this->addField(self::FIELD_ID_SOURCE_APPEAL, $value);
    }

    public function setFieldDiscountCardNumber($value)
    {
        return $this->addField(self::FIELD_ID_DISCOUNT_CARD_NUMBER, $value);
    }

    protected function preparePush()
    {
        parent::preparePush();

        if($email = $this->getFromBody('client_email')) {
            $client = $this->client->clients()->setQuery($email)->push();

            if($client->isNotEmpty()) {
                $data = $client->first();
                $this->setClientId($data['id']);
            }
        }
    }
}