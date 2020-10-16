<?php
/**
 * Dependency injection configuration file (DIC configuration)
 * @author Lucas Lima <lucasdevelopmaster@gmail.com>
 * @api 1.0.0
 */

 $container = $app->getContainer();

 $container['logger'] = function($c) {
    $settings = $c['settings']['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['logger-producer'] = function($c) {
    $settings = $c['settings']['logger-producer'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};