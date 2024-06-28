<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Controllers\HomeController;

return function(\Slim\App $app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/login', function (Request $request, Response $response, array $args){
        $view = Twig::fromRequest($request);
        return $view->render($response, 'auth/login.twig');
    });
    $app->get('/register', function (Request $request, Response $response, array $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'auth/register.twig');
    });
    $app->post('/login', function (Request $request, Response $response, array $args) {
        var_dump($_POST);
        return $response;
    });
};