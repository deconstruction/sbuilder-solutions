<?php

namespace UseDesk\Cases\TokioCity\Requests\Tickets;

class RequestCreateTicket extends \UseDesk\Requests\Tickets\RequestCreateTicket
{
    /**
     * ID поля ресторана
     */
    const FIELD_ID_RESTAURANT      = 18617;

    /**
     * ID поля даты визита
     */
    const FIELD_ID_DATE_TIME_VISIT = 18646;

    /**
     * ID поля номера заказа
     */
    const FIELD_ID_ORDER_ID             = 18613;

    /**
     * ID поля направления
     */
    const FIELD_ID_DIRECTION            = 18622;

    /**
     * ID поля типа заказа
     */
    const FIELD_ID_ORDER_TYPE           = 18637;

    /**
     * ID поля инициатора
     */
    const FIELD_ID_INITIATOR            = 18638;

    /**
     * ID поля источника обращения
     */
    const FIELD_ID_SOURCE_APPEAL        = 18639;

    /**
     * ID поля номера дисконтной карты
     */
    const FIELD_ID_DISCOUNT_CARD_NUMBER = 18640;

    /**
     * Ссылка на изображение
     *
     * null|string @var
     */
    private $imageUrl;

    /**
     * @var null|string
     */
    private $review;

    /**
     * @var null|int
     */
    public $systemReviewId;

    /**
     * @param $client
     * @param $method
     */
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

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldRestaurantId($value)
    {
        return $this->addField(self::FIELD_ID_RESTAURANT, $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldDateVisit($value)
    {
        return $this->addField(self::FIELD_ID_DATE_TIME_VISIT, $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldOrderId($value)
    {
        return $this->addField(self::FIELD_ID_ORDER_ID, $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldDirection($value)
    {
        return $this->addField(self::FIELD_ID_DIRECTION, $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldTypeOrder($value)
    {
        return $this->addField(self::FIELD_ID_ORDER_TYPE, $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldInitiator($value)
    {
        return $this->addField(self::FIELD_ID_INITIATOR, $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldSourceAppeal($value)
    {
        return $this->addField(self::FIELD_ID_SOURCE_APPEAL, $value);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setFieldDiscountCardNumber($value)
    {
        return $this->addField(self::FIELD_ID_DISCOUNT_CARD_NUMBER, $value);
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function addImageUrl($value)
    {
        $this->imageUrl = $value;

        return $this;
    }

    public function addReview($value)
    {
        $this->review = $value;

        return $this;
    }

    public function addSystemReviewId($value)
    {
        $this->systemReviewId = $value;
        
        return $this;
    }

    /**
     * @return void
     */
    protected function preparePush()
    {
        parent::preparePush();

        if($this->review) {
            $comment = "Текст отзыва: $this->review" . PHP_EOL;
            $comment .= $this->getFromBody('message', '') . PHP_EOL;
            $this->setMessage($comment);
        }

        if($this->imageUrl) {
            $comment = $this->getFromBody('message', '') . PHP_EOL;
            $comment .= "Ссылка на изображение: $this->imageUrl";
            $this->setMessage($comment);
        }

        if($email = $this->getFromBody('client_email')) {
            $client = $this->client->clients()->setQuery($email)->push();

            if($client->isNotEmpty()) {
                $data = $client->first();
                $this->setClientId($data['id']);
            }
        }
    }
}