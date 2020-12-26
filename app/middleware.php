<?php
declare(strict_types=1);

use Slim\App;

use Tuupola\Middleware\JwtAuthentication;
use App\Application\Middleware\SessionMiddleware;

const JWT_SECRET = "makey1234567";

return function (App $app) {
    //$app->add(SessionMiddleware::class);
    $app->add(new JwtAuthentication([
        "path" => "/api",
        "secure" => false,
        "secret" => JWT_SECRET,
        "passthrough" => ["/login","/signin"],
        "attribute" => "decoded_token_data",
        "algorithm" => ["HS256"],
        "error" => function  ($response, $arguments) {
            $data = array('ERREUR' => 'ERREUR', 'ERREUR' => 'AUTO');        
            return $response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($data));
        }
    ]));
};
