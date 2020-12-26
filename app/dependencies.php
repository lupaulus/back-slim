<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\Tools\Setup;





return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },

        EntityManager::class => function(ContainerInterface $c){
            $settings = $c->get('settings');
            $settings = $settings['doctrine'];

            $config = Setup::createAnnotationMetadataConfiguration(
                $settings['meta']['entity_path'],
                $settings['meta']['auto_generate_proxies'],
                $settings['meta']['proxy_dir'],
                $settings['meta']['cache'],
                false
            );

            $em = EntityManager::create($settings['connection'], $config);
            return $em;
        }
    ]);
};
