<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\Login\Login;
use App\Domain\Login\LoginRepository;
use App\Domain\User\LoginNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use Doctrine\ORM\EntityManager;
use Userdb;


class InMemoryUserRepository implements UserRepository
{


    /**
     * @var LoginRepository
     *
     */
    private $loginRepository;

    private $entityManager;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param array|null $users
     */
    public function __construct(LoginRepository $loginRepository, EntityManager $entityManager)
    {
        $this->loginRepository = $loginRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $loginrepo = $this->entityManager->getRepository('user');
        $res = $loginrepo->findAll();
        return $res;

    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        $loginrepo = $this->entityManager->getRepository('user');
        $val = $loginrepo->findOneBy(array('idUser' => $id));
        if($val == null)
        {
            throw new UserNotFoundException;
        }
        return $val;
    }
    

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserWithIdLogin(int $idLogin) : User
    {
        $loginrepo = $this->entityManager->getRepository('user');
        $val = $loginrepo->findOneBy(array('idLogin' => $idLogin));
        if($val == null)
        {
            throw new UserNotFoundException;
        }
        return $val;
    }

    public function createUser(User $user) : bool
    {
        $l = new Login();
        $l->setUsername($user->username);
        $l->setPassword($user->password);
        try
        {
            $this->loginRepository->findbyUsername($l->getUsername());
        }
        catch(LoginNotFoundException $ex)
        {
            // if user not exist create them
            $login = $this->loginRepository->createLogin($l);
            $user->setLogin($login);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return true; 
        }
        // if user exist with existant username return false
        return false;
        
        
    }
}
