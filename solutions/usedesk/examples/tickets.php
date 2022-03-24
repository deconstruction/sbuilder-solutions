<?php

require_once __DIR__ . '/autoloader.php';

// Клиент
$client   = new sUseDeskClient();

// Список тикетов
$client
    ->tickets()
    ->setCreatedAfter('2022-03-23 19:02')
    ->push();

// Отдельный тикет
$client
    ->ticket(84526656)
    ->push();

// Создание тикета
$client
    ->createTicket()
    ->setSubject('Subject')
    ->setMessage('Message')
    ->push();