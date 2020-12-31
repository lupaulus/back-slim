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
        if($this->userRepository->createUser($u))
        {
            //OK with 200
            return $this->respondWithData($array,200);
        }
        // User is not created 400 to client
        return $this->respondWithData(json_encode(array("error" => "client not created")),400);
            
    }
}
