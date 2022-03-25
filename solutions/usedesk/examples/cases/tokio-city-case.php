<?php

use UseDesk\Cases\TokioCity\UseDeskTokioCity;

require_once __DIR__ . '/../autoloader.php';

$useDesk = new UseDeskTokioCity();

$response = $useDesk->request()
    ->setClientEmail('te21321st@mail.ru')
    ->setMessage('test message')
    ->setSubject('test subject')
    ->push();

var_dump($response);