<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Login;

use App\Domain\Login\Login;
use App\Domain\Login\LoginRepository;
use App\Domain\User\LoginNotFoundException;
use Logindb;


class InMemoryLoginRepository implements LoginRepository
{
    /**
     * @var Login[]
     */
    private $logins;

    /**
     * InMemoryLoginRepository constructor.
     *
     * @param array|null $Logins
     */
    public function __construct(array $logins = null)
    {
        $this->logins = $logins ?? [
        ];
    }

    /**
     * @return Login[]
     */
    public function findAll(): array
    {
        global $entityManager;
        $loginrepo = $entityManager->getRepository('Logindb');
        $arrayLogindb = $loginrepo->findAll();
        $res = array();
        foreach($arrayLogindb as &$val)
        {
            if($val instanceof Logindb )
            {
                array_push($res,$val->convert());
            }
        }

        return $res;
    }

    /**
     * @param int $id
     * @return Login
     * @throws LoginNotFoundException
     */
    public function findLoginOfId(int $id): Login
    {
        global $entityManager;
        $loginrepo = $entityManager->getRepository('Logindb');
        $val = $loginrepo->findOneBy(array('idLogin' => $id));
        if($val == null)
        {
            throw new LoginNotFoundException;
        }
        if($val instanceof Logindb )
        {
            $res = $val->convert();
        }
        return $res;
    }

    /**
     * @param int $id
     * @return Login
     * @throws LoginNotFoundException
     */
    public function findbyUsername(string $username):Login
    {
        global $entityManager;
        $loginrepo = $entityManager->getRepository('Logindb');
        $val = $loginrepo->findOneBy(array('username' => $username));
        if($val == null)
        {
            throw new LoginNotFoundException;
        }
        if($val instanceof Logindb )
        {
            $res = $val->convert();
        }
        return $res;
    }

    public function createLogin(Login $login): int
    {
        global $entityManager;
        $loginbase = $login->convertDb();
        $entityManager->persist($loginbase);
        $entityManager->flush();
        
        $loginrepo = $entityManager->getRepository('Logindb');
        $val = $loginrepo->findOneBy(array('username' => $login->username));
        if($val == null)
        {
            throw new LoginNotFoundException;
        }
        if($val instanceof Logindb )
        {
            return $val->getIdLogin();
        }
        return -1;
        
    }


}
