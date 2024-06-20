<?php
declare(strict_types=1);
ini_set('display_errors', true);

use App\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';
// create app
$app = AppFactory::create();

// create twig
$twig = Twig::create(__DIR__ . '/../resources/views', [
    'cache' => false,
    'auto_reload' => true,
]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// adding routes //TODO: abstract routes
$app->get('/', [HomeController::class, 'index']);

$app->run();

//TODO: make constants file
//TODO: start with the login form