<?php
declare(strict_types=1);

namespace App\Domain\Order;

interface OrderRepository
{
    
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): Order;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserWithIdLogin(int $idLogin) : Order;

    public function createUser(Order $user) : bool;
}
