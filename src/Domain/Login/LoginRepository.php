<?php
declare(strict_types=1);

namespace App\Domain\Login;

interface LoginRepository
{
    /**
     * @return Login[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Login
     * @throws LoginNotFoundException
     */
    public function findLoginOfId(int $id): Login;

    /**
     * @param int $id
     * @return Login
     * @throws LoginNotFoundException
     */
    public function findbyUsername(string $username):Login;

    public function createLogin(Login $username): int;

    
}
