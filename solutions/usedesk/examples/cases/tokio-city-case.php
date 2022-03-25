<?php

//if(!mkdir('logs/' . date('Y/m/d'), 0755, true) && !is_dir('logs/' . date('Y/m/d'))) {
//    throw new \RuntimeException(sprintf('Directory "%s" was not created', 'logs/' . date('Y/m/d')));
//}

echo "<pre><code>";

use UseDesk\Cases\TokioCity\UseDeskTokioCity;

require_once __DIR__ . '/../autoloader.php';

$useDesk = new UseDeskTokioCity();

$request = $useDesk->request()
    ->setFieldRestaurantId(123)
    ->setFieldDateVisit('25.03.2022 21:11')
    ->addFile('C:\OpenServer\domains\sbuilder-wiki\solutions\usedesk\examples\cases\test-file.txt')
    ->addFile('C:\OpenServer\domains\sbuilder-wiki\solutions\usedesk\examples\cases\test-file2.txt')
    ->setClientEmail('test' . mt_rand(1, 1) . '@mail.ru')
    ->setClientPhone(89112223344)
    ->setClientName('Имя Клиента')
    ->setMessage('test message')
    ->setSubject('тестовое сообщение')
    ->push();

var_dump($request->getResponse());

echo "<br>";

if(!$request->hasErrors()) {
    $ticket = $useDesk->client()->ticket($request->get('ticket_id'))->push();

    var_dump($ticket);
}

echo "</code></pre>";