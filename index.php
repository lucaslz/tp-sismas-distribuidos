<?php

// production
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Load all libraries
require_once __DIR__ .'/vendor/autoload.php';

$settings = require __DIR__ . "/src/settings.php";
$app = new app\App($settings);

require __DIR__ . "/src/dependencies.php";

$container['logger']->info('Iniciando sistema.');