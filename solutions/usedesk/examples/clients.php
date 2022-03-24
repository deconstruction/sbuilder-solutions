<?php

require_once __DIR__ . '/autoloader.php';

$client = new sUseDeskClient();

// Получить список клиентов
$client->clients()
    ->setQuery('a.litvinyuk')
    ->setSearchTypeFullMatch()
    ->push();

// Отдельный клиент
$client->client(63204544)
    ->push();

// Создать клиента
$client->createClient()
    ->setName('Client Name')
    ->setPhone(89112223344)
    ->push();

// Обновить клиента
$update = $client->updateClient(63204544)
    ->setName('Client Name 3')
    ->push();

$client = $client->client(63204544)
    ->push();

dd(array($update->getResponse(), $client->getResponse()));