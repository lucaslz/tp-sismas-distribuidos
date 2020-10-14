<?php

$cliente = new GearmanClient();
$cliente->addServer('172.21.0.3', 4730);

$cliente->setCompleteCallback('done');

for ($i=0; $i < 5; $i++) {
        $cliente->addTask('countWords', 'Hello Monica!', null, $i);
}

$cliente->runTasks();
echo "DONE\n";

function done(GearmanTask $task) {
        echo $task->data() . ' | ' . $task->unique() . "\n";
}


