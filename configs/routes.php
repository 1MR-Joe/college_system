<?php
declare(strict_types=1);

use App\Controllers\AuthController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Controllers\HomeController;

return function(\Slim\App $app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/login', [AuthController::class, 'loginView']);
    $app->get('/register', [AuthController::class, 'registerView']);

    $app->post('/login', [AuthController::class, 'loginUser']);
    $app->post('/register', [AuthController::class, 'registerUser']);
};