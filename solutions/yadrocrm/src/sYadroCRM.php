<?php

class sYadroCRM
{
    const KEY = '7e64081a';

    public static function push()
    {
        $introvertUrl = 'https://api.yadrocrm.ru/integration/site?key=' . self::KEY;

        $cookieData = array();
        if (isset($_COOKIE['introvert_cookie'])) {
            $cookieData = json_decode($_COOKIE['introvert_cookie'], true) ?: array(); // данные сохраняемые js скриптом
        }

        $postArr = array_merge($cookieData, $_POST);

        $response = 'Error';

        $opts = array(
            'http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($postArr),
                    'timeout' => 2,
                ),
        );

        try {
            $response = file_get_contents($introvertUrl, false, stream_context_create($opts));
        } catch (Exception $e) {}

        self::log($response);

        return $response;
    }

    private static function log($response)
    {
        if (function_exists('sb_add_system_message')) {
            sb_add_system_message('Запуск скрипта: ' . __CLASS__);

            sb_add_system_message($response);
        }
    }
}
