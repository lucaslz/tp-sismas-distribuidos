<?php

// Definindo o timezone correto para o logger funcionar corretamente
date_default_timezone_set('UTC');

// Iniciando configuracoes basicas e bibliotecas externas
require __DIR__ . "/index.php";

// Iniciando o consumidor, e adicionar o IP e porta do servidor que faz a ponte entre produtor e consumidor
$container['logger-producer']->info('Iniciado producer.');
$cliente = new GearmanClient();
$cliente->addServer('172.25.0.2', 4730);

// Callback que será chamado caso os dados sejam processados corretamente
$container['logger-producer']->info('Definindo mensagem callback de sucesso no producer');
$cliente->setCompleteCallback('done');

// Callbacks para tratamento de erros
$gmc->setStatusCallback("getMonitorStatus");
$gmc->setFailCallback("getMonitorFail");

// Pegando o arquivo e passando para o monitor
$container['logger-producer']->info('Enfileirando consumidores para mandar o arquivo.');
$cliente->addTask('getMonitor', $argv[1]);

// Rodando as tasks
$cliente->runTasks();
$container['logger-producer']->info('Tasks dos producer finalizadas com sucesso.');

// Metodo a ser chamado caso os dados sejam processados corretamente
function done(GearmanTask $task) {
        $date = new DateTime();
        $dados = sprintf("%s \nID da operação: %s \nData da operação: %s\n",
                $task->data(),
                $task->unique(),
                $date->format('Y-m-d H:i:s')
        );
        echo $dados;
}

// Metodo responsavel por retornar as informacoes de status
function reverse_status($task)
{
    echo "STATUS: " . $task->jobHandle() . " - " . $task->taskNumerator() .
         "/" . $task->taskDenominator() . "\n";
}


// Metodo responsavel por retornar o ponto de falha da execucao
function reverse_fail($task)
{
    echo "FAILED: " . $task->jobHandle() . "\n";
}
