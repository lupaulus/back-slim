<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use App\Domain\User\UserRepository;
use App\Domain\Login\LoginRepository;
use App\Domain\Order\OrderRepository;
use App\Domain\Product\ProductRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\Login\InMemoryLoginRepository;
use App\Infrastructure\Persistence\Order\InMemoryOrderRepository;
use App\Infrastructure\Persistence\Product\InMemoryProductRepository;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        LoginRepository::class => \DI\autowire(InMemoryLoginRepository::class),
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        ProductRepository::class => \DI\autowire(InMemoryProductRepository::class),
        OrderRepository::class => \DI\autowire(InMemoryOrderRepository::class)
    ]);
};
