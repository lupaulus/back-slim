<?php
declare(strict_types=1);

use Slim\App;
use App\Application\Actions\Login\LoginAsAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\User\AddUser;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        $response->withHeader("Content-Type", "application/json")
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');

        return $response;
    });

    
    $app->post('/signin', AddUser::class);

    $app->post('/login', LoginAsAction::class);

    $app->get('/api/produit', GetProduit::class);

    $app->post('/api/order', CreateOrder::class);

    $app->get('/api/order', GetOrder::class);
};
