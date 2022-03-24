<?php

require_once __DIR__ . '/autoloader.php';

$client = new sUseDeskClient();

$fields = $client->fields()->push();

dd($fields);