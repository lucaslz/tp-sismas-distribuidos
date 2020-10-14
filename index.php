<?php

require_once './vendor/autoload.php';

$wordManager = new app\word\WordManager("pessoas.json");
$wordManager->loadFile();

$wordCounter = new \app\word\WordCounter("Lucas Lima");
echo $wordCounter->totalWords() . "\n";
echo implode("\n", $wordCounter->totalCharactersInEachWord());
echo "\n";