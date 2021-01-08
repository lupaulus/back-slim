<?php
declare(strict_types=1);

use Slim\App;

use Tuupola\Middleware\JwtAuthentication;

// ENV
const JWT_SECRET = "abcde1234";

return function (App $app) {
    $app->add(new JwtAuthentication([
        "path" => "/api",
        "secure" => false,
        "secret" => JWT_SECRET,
        "passthrough" => ["/login","/signin"],
        "attribute" => "decoded_token_data",
        "algorithm" => ["HS256"],
        "error" => function  ($response, $arguments) {
            $data["status"] = "error";
            $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
    ]));
};
