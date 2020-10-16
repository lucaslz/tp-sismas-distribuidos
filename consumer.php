<?php

require __DIR__ . "/index.php";

class Monitor
{
    public function __construct()
    {
    }

    public function init(GearmanJob $job)
    {
        $fileName = $job->workload();
        $dir = __DIR__ . "/static_files/" . $fileName;

        $path_parts = pathinfo($dir);
        $data = file_get_contents($dir);

        if ($path_parts === 'json') {
            $data = json_decode($data);
        }

        return "O arquivo " . $fileName . " tem: " . str_word_count($data) . " palavras.";
    }
}

$container['logger']->info('Iniciado consumidor.');
$worker = new GearmanWorker();
$worker->addServer('gearman');

$container['logger']->info('Criando espelho entre funcoes no consumidor.');
$worker->addFunction('getMonitor', array(new Monitor(), 'init'));

$container['logger']->info('Colocando consumidor para ficar escutando.');
while ($worker->work());