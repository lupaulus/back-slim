<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;


use Firebase\JWT\JWT;
use App\Domain\Login\Login;
use App\Domain\Login\LoginNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class LoginAsAction extends LoginAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $this->response = $this->response->withHeader("Content-Type", "application/json");
        $this->response = $this->response->withHeader("Access-Control-Expose-Headers","Authorization");
        $this->logger->debug("Login Action: Login");
        $json = $this->request->getBody();
        $this->logger->debug("Data array user : ".strval($json));
        $array = json_decode(strval($json));
        $login = new Login();
        $login->set($array);
        
        try
        {
            $user = $this->loginRepository->findbyUsername($login->getUsername());
        }
        catch(LoginNotFoundException $e)
        {
            $this->logger->debug("Login Action: User null");
            // No user with this username
            $this->response = $this->response->withStatus(400);
            $this->response->getBody()->write(json_encode(array("error" => "User not exists")));
            return $this->response;
        }
    
        
        // Check if it is the right user
        if($user->getPassword() == $login->getPassword())
        {
            $this->logger->debug("Login Action: Login successfull, token generated");
            $issuedAt= time();
            $expirationTime= $issuedAt+3600; // jwtvalid for 3600 seconds from the issued time
            $userValue = $this->userRepository->findUserWithIdLogin($user->getIdLogin());
            $payload = array('userid' => strval($userValue->getId()),'iat' => $issuedAt,'exp' => $expirationTime);
            $token = JWT::encode($payload,JWT_SECRET, "HS256");
            $this->logger->debug("token = {$token}");
            $this->response = $this->response->withHeader("Authorization", "Bearer {$token}");
            $this->response->getBody()->write(json_encode($userValue));
            return $this->response;
        }
        // Wrong password
        $this->logger->debug("Login Action: WrongPassword");
        $this->response = $this->response->withStatus(400);
        $this->response->getBody()->write(json_encode(array("error" => "Wrong password")));
        
        return $this->response;
    }
}
