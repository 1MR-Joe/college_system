<?php
declare(strict_types=1);
ini_set('display_errors', true);

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// path constants
require __DIR__.'/../configs/path_constants.php';

// auto loading
require __DIR__ . '/../vendor/autoload.php';

// environment variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// DI container
// I was using the example in slim documentation
// then I moved container bindings to its own file
// then moved the whole container definition in another file
$container = require CONFIGS_PATH . '/Container/container.php';
AppFactory::setContainer($container);

// create app
$app = AppFactory::create();

// create twig instance
// but now twig is one of container bindings and can be injected

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

// routes are abstracted away in their own file
$router = require CONFIGS_PATH . '/routes.php';
$router($app);

// database connection was abstracted away to its own file

$app->run();
//TODO: start with the login form