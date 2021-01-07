<?php
declare(strict_types=1);

use Slim\App;

use Tuupola\Middleware\JwtAuthentication;
use App\Application\Middleware\SessionMiddleware;

// ENV
const JWT_SECRET = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

return function (App $app) {
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
