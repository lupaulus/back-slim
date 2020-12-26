<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Login;

use App\Domain\Login\Login;
use App\Domain\Login\LoginRepository;
use App\Domain\User\LoginNotFoundException;
use Doctrine\ORM\EntityManager;
use Logindb;


class InMemoryLoginRepository implements LoginRepository
{
    /**
     * @var Login[]
     */
    private $logins;

    private $entityManager;

    /**
     * InMemoryLoginRepository constructor.
     *
     * @param array|null $Logins
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->logins = $logins ?? [];
        $this->entityManager = $entityManager;
    }

    /**
     * @return Login[]
     */
    public function findAll(): array
    {
        $loginrepo = $this->entityManager->getRepository(Login::class);
        $res = $loginrepo->findAll();
        return $res;
    }

    /**
     * @param int $id
     * @return Login
     * @throws LoginNotFoundException
     */
    public function findLoginOfId(int $id): Login
    {
        $loginrepo = $this->entityManager->getRepository(Login::class);
        $val = $loginrepo->findOneBy(array('idLogin' => $id));
        if($val == null)
        {
            throw new LoginNotFoundException;
        }
        return $val;
    }

    /**
     * @param int $id
     * @return Login
     * @throws LoginNotFoundException
     */
    public function findbyUsername(string $username):Login
    {
        $loginrepo = $this->entityManager->getRepository(Login::class);
        $val = $loginrepo->findOneBy(array('username' => $username));
        if($val == null)
        {
            throw new LoginNotFoundException;
        }
        return $val;
    }

    public function createLogin(Login $loginbase): Login
    {
        $this->entityManager->persist($loginbase);
        $this->entityManager->flush();
        $loginrepo = $this->entityManager->getRepository(Login::class);
        $val = $loginrepo->findOneBy(array('username' => $loginbase->getUsername()));
        if($val == null)
        {
            throw new LoginNotFoundException;
        }
        return $val;
    }


}
