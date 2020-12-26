<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\User;
use App\Domain\Login\Login;
use Psr\Http\Message\ResponseInterface as Response;

class AddUser extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $this->logger->debug("User Action: ADD USER");
        $json = $this->request->getBody();
        $this->logger->debug("Data array user : ".strval($json));
        $array = json_decode(strval($json));
        $this->logger->debug("obj : ".gettype($array));
        $u = new User();
        $u->set($array);
        $this->userRepository->createUser($u);
        $l = new Login();
        $this->loginRepository->createLogin($l);
        return $this->respondWithData($array);
    }
}
