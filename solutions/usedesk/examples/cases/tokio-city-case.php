<?php

require_once __DIR__ . '/../autoloader.php';

$useDesk = new UseDeskTokioCity();

$useDesk->getRequest()
    ->setClientEmail('test@mail.ru')
    ->setMessage('test message')
    ->setSubject('test subject')
    ->push();