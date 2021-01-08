<?php
declare(strict_types=1);

namespace App\Domain\Order;

interface OrderRepository
{
    
    /**
     * @return Order[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Order
     * @throws OrderNotFoundException
     */
    public function findOrderOfId(int $id): Order;


    public function createOrder(Order $Order) : bool;
}
