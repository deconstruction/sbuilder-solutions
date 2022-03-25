<?php

//if(!mkdir('logs/' . date('Y/m/d'), 0755, true) && !is_dir('logs/' . date('Y/m/d'))) {
//    throw new \RuntimeException(sprintf('Directory "%s" was not created', 'logs/' . date('Y/m/d')));
//}

session_start();

echo "<pre><code>";

use UseDesk\Cases\TokioCity\UseDeskTokioCity;

require_once __DIR__ . '/../autoloader.php';

$useDesk = new UseDeskTokioCity();

$request = $useDesk->request()
    ->setClientEmail('test' . mt_rand(1, 1) . '@mail.ru')
    ->setMessage('test message')
    ->setSubject('тестовое сообщение')
    ->addSystemReviewId(123);

$push = $request->push();

var_dump($push->getResponse());


echo "</code></pre>";