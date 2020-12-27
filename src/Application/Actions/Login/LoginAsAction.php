<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;


use Firebase\JWT\JWT;
use App\Domain\Login\Login;
use App\Domain\Login\LoginRepository;
use App\Infrastructure\Persistence\Login\InMemoryLoginRepository;
use Psr\Http\Message\ResponseInterface as Response;

class LoginAsAction extends LoginAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $this->logger->debug("Login Action: Login");
        $json = $this->request->getBody();
        $this->logger->debug("Data array user : ".strval($json));
        $array = json_decode(strval($json));
        $login = new Login();
        $login->set($array);
        $userid = $login->getUsername();
        $user = $this->loginRepository->findbyUsername($userid);

        if($user == null)
        {
            $this->logger->debug("Login Action: User null");
            // No user with this username
            return $this->response->withStatus(501);
        }
        // Check if it is the right user
        if($user->getPassword() == $login->getPassword())
        {
            $this->logger->debug("Login Action: Login successfull, token generated");
            $issuedAt= time();
            $expirationTime= $issuedAt+60; // jwtvalid for 60 seconds from the issued time
            $payload = array('userid' => $userid,'iat' => $issuedAt,'exp' => $expirationTime);
            $token = JWT::encode($payload,JWT_SECRET, "HS256");
            $this->response = $this->response->withHeader("Authorization", "Bearer {$token}")->withHeader("Content-Type", "application/json");
            $this->response->withStatus(200);
            return $this->response;
        }
        // Wrong password
        $this->logger->debug("Login Action: WrongPassword");
        return $this->response->withStatus(502);
    }
}
