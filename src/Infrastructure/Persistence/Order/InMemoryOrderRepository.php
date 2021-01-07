<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\Login\Login;
use App\Domain\Login\LoginRepository;
use App\Domain\Login\LoginNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;


class InMemoryOrderRepository implements UserRepository
{


    /**
     * @var LoginRepository
     *
     */
    private $loginRepository;

    private $logger;

    private $entityManager;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param array|null $users
     */
    public function __construct(LoggerInterface $logger,LoginRepository $loginRepository, EntityManager $entityManager)
    {
        $this->loginRepository = $loginRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $loginrepo = $this->entityManager->getRepository(User::class);
        $res = $loginrepo->findAll();
        return $res;

    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        $loginrepo = $this->entityManager->getRepository(User::class);
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
        $userrepo = $this->entityManager->getRepository(User::class);
        $val = $userrepo->findOneBy(array('login' => $idLogin));
        return $val;
    }

    public function createUser(User $user) : bool
    {
        $this->logger->debug("Login created");
        $l = new Login();
        $l->setUsername($user->username);
        $l->setPassword($user->password);
        try
        {
            $this->logger->debug("Search for Login");
            $this->loginRepository->findbyUsername($l->getUsername());
        }
        catch(LoginNotFoundException $ex)
        {
            $this->logger->debug("Login not exist, Login will persist");
            // if user not exist create them
            $login = $this->loginRepository->createLogin($l);
            $user->setLogin($login);
            $this->logger->debug("User will persist");
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return true; 
        }
        // if user exist with existant username return false
        return false;
        
        
    }
}
