<?php

// Iniciando configuracoes basicas e bibliotecas externas
require __DIR__ . "/index.php";

// Class monitor que liga o consumidor ao produtor
class Monitor
{
    /**
     * Construtor padrao da classe
     */
    public function __construct()
    {
    }

    /**
     * Metodo responsavel por pegar o nome do arquivo,
     * montar o caminho padrao do mesmo. Tambem e
     * responsavel por fazer a contagem dos caracteres
     * e retornar as informacoes.
     *
     * @param GearmanJob $job
     * @return void
     */
    public function init(GearmanJob $job)
    {
        $dados = $job->workload();
        return "O arquivo " . $fileName . " tem: " . str_word_count($dados) . " palavras.";
    }
}

// Iniciado o Gearman e adicionando o IP do servidor que
// faz a ponte entre produtor e consumidor
$container['logger']->info('Iniciado consumidor.');
$worker = new GearmanWorker();
$worker->addServer('gearman');

// Trecho de codigo responsavel por pegar os dados do produtor e passar para o monitor
$container['logger']->info('Criando espelho entre funcoes no consumidor.');
$worker->addFunction('getMonitor', array(new Monitor(), 'init'));

// Colocando o consumidor para ficar escutando um produtor
$container['logger']->info('Colocando consumidor para ficar escutando.');
while ($worker->work());