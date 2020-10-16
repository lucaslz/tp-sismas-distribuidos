<?php

// Abilitando erros a nível de producao, ou seja nem tudo sera sinalizado
// Somente erros fatais e warnings
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ERROR | E_WARNING);

// Carrega todas a bibliotecas externas utilizadas no trabalho
require_once __DIR__ .'/vendor/autoload.php';

// Inicia a aplicacao e carrega o arquivo de configuracoes padrao
$settings = require __DIR__ . "/src/settings.php";
$app = new app\App($settings);

// Carrega o gerenciador de dependencias e inicia o sistema
require __DIR__ . "/src/dependencies.php";
$container['logger']->info('Iniciando sistema.');