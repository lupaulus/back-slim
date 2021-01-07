<?php
declare(strict_types=1);

namespace App\Domain\User;

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
    public function findUserOfId(int $id): User;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserWithIdLogin(int $idLogin) : User;

    public function createUser(User $user) : bool;
}
