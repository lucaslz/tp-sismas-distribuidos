<?php

$worker = new GearmanWorker();
$worker->addServer('gearman'); // gearman hostname is linked, required

$worker->addFunction('countWords', 'doCountWords', $count = 0);

while ($worker->work());

function doCountWords(GearmanJob $job, &$count) {
    $count++;
    return $count . ': ' . strrev($job->workload()) . "\n";
}

