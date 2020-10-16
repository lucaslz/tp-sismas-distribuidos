<?php
date_default_timezone_set('UTC');

require __DIR__ . "/index.php";

$container['logger-producer']->info('Iniciado producer.');
$cliente = new GearmanClient();
$cliente->addServer('172.25.0.2', 4730);

$container['logger-producer']->info('Definindo mensagem callback de sucesso no producer');
$cliente->setCompleteCallback('done');

$container['logger-producer']->info('Enfileirando consumidores para mandar o arquivo.');
$cliente->addTask('getMonitor', $argv[1]);

$cliente->runTasks();
$container['logger-producer']->info('Tasks dos producer finalizadas com sucesso.');

function done(GearmanTask $task) {
        $date = new DateTime();
        $dados = sprintf("%s \nID da operação: %s \nData da operação: %s\n",
                $task->data(),
                $task->unique(),
                $date->format('Y-m-d H:i:s')
        );
        echo $dados;
}


