<?php

/**
 * Defines some default settings for the software
 *
 * @author Lucas Lima <lucasdevelopmaster@email.com>
 */

return [
    'settings' => [
        'logger' => [
            'name' => 'consumer',
            'path' => '/var/logs/tp-sd/app.log',
            'level' => \Monolog\Logger::DEBUG
        ],
        'logger-producer' => [
            'name' => 'producer',
            'path' => '/var/www/logs/app.log',
            'level' => \Monolog\Logger::DEBUG
        ]
    ]
];