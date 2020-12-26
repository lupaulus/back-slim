<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;


use Firebase\JWT\JWT;
use App\Domain\Login\Login;
use App\Infrastructure\Persistence\Login\InMemoryLoginRepository;
use Psr\Http\Message\ResponseInterface as Response;

class LoginAsAction extends LoginAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $json = $this->request->getBody();
        $array = json_decode(strval($json));
        $login = Login::Construct($array);
        $userid = $login->getUsername();

        $repo = new InMemoryLoginRepository();
        $user = $repo->findbyUsername($userid);

        // Check si c'est le bon user
        if($user->getPassword() == $login->getPassword())
        {
            return null;
        }


        $issuedAt= time();
        $expirationTime= $issuedAt+60; // jwtvalid for 60 seconds from the issued time
        $payload = array('userid' => $userid,'iat' => $issuedAt,'exp' => $expirationTime);
        $token = JWT::encode($payload,JWT_SECRET, "HS256");
        $this->response = $this->response->withHeader("Authorization", "Bearer {$token}")->withHeader("Content-Type", "application/json");
        $this->response->getBody()->write(json_encode($login));
        return $this->response;
    }
}
