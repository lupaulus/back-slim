<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true,
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
                'file_permission' => 0775
            ],
            'doctrine' => [
                'meta' => [
                    'entity_path' => [
                        '/src'
                    ],
                    'auto_generate_proxies' => true,
                    'proxy_dir' =>  __DIR__.'/../cache/proxies',
                    'cache' => null,
                ],
                'connection' => [
                    'driver'   => 'pdo_pgsql',
                    'host'     => 'db',
                    'dbname'   => 'dbshop',
                    'user'     => 'dbshop',
                    'password' => 'changeme',
                ]
            ]
        ],
    ]);
};