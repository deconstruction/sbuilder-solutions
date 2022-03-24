<?php

namespace UseDesk;

/**
 * Экземпляр данного класса возвращается после выполнения запроса
 */
class sUseDeskResponse
{
    /**
     * Отправленные данные
     *
     * @var array
     */
    private $body;

    /**
     * Полученные данные
     *
     * @var array
     */
    private $response;

    /**
     * @param array $body
     * @param array $response
     */
    public function __construct($body, $response)
    {
        $this->body     = $body;
        $this->response = $response;
    }

    /**
     * Есть ли ошибки
     *
     * @return bool
     */
    public function hasErrors()
    {
        return isset($this->response['error']);
    }

    /**
     * Сообщения с ошибками
     *
     * @return mixed|null
     */
    public function getErrorMessage()
    {
        if($this->hasErrors()) {
            return $this->response['error'];
        }

        return null;
    }

    /**
     * Получить отправленные данные
     *
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Получить отчет
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Получить значение
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->response[$key]) ? $this->response[$key] : null;
    }

    /**
     * Пустой ли ответ
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->response);
    }

    /**
     * Не пустой ли ответ
     *
     * @return bool
     */
    public function isNotEmpty()
    {
        return !$this->isEmpty();
    }

    /**
     * Получить первый элемент ответа
     *
     * @return array|mixed
     */
    public function first()
    {
        return isset($this->response[0]) ? $this->response[0] : $this->response;
    }

    /**
     * Кол-во элементов в ответе
     *
     * @return int
     */
    public function count()
    {
        return count($this->response);
    }
}