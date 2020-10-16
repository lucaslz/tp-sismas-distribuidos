<?php
/**
 * Arquivo de configuracao de injecao de dependencia (DIC configuration)
 *
 * @author Lucas Lima <lucasdevelopmaster@gmail.com>
 * @api 1.0.0
 */

//Buscando o container de configuracao
$container = $app->getContainer();

//Configuracao do log do consumidor
$container['logger'] = function($c) {
    $settings = $c['settings']['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//Configuracao do log do produtor
$container['logger-producer'] = function($c) {
    $settings = $c['settings']['logger-producer'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};