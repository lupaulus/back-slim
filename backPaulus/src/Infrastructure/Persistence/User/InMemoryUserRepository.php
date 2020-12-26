<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\Login\Login;
use App\Domain\Login\LoginRepository;
use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use Userdb;


class InMemoryUserRepository implements UserRepository
{


    /**
     * @var LoginRepository
     *
     */
    private $loginRepository;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param array|null $users
     */
    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        global $entityManager;
        $loginrepo = $entityManager->getRepository('Userdb');
        $arrayLogindb = $loginrepo->findAll();
        $res = array();
        foreach($arrayLogindb as &$val)
        {
            if($val instanceof Userdb )
            {
                array_push($res,$val->convert());
            }
        }
        return $res;

    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        global $entityManager;
        $loginrepo = $entityManager->getRepository('Userdb');
        $val = $loginrepo->findOneBy(array('idUser' => $id));
        if($val == null)
        {
            throw new UserNotFoundException;
        }
        if($val instanceof Userdb )
        {
            $res = $val->convert();
        }
        return $res;
    }
    

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserWithIdLogin(int $idLogin) : User
    {
        global $entityManager;
        $loginrepo = $entityManager->getRepository('Userdb');
        $val = $loginrepo->findOneBy(array('idLogin' => $idLogin));
        if($val == null)
        {
            throw new UserNotFoundException;
        }
        if($val instanceof Userdb )
        {
            $res = $val->convert();
        }
        return $res;
    }

    public function createUser(User $user) : int
    {
        global $entityManager;
        $l = new Login();
        $l->setUsername($user->username);
        $l->setPassword($user->password);
        
        $idLogin = $this->loginRepository->createLogin($l);
        $user->setIdLogin($idLogin);

        $entityManager->persist($userbase);
        $entityManager->flush();
        return -1; 
    }
}
