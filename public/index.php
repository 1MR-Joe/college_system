<?php
declare(strict_types=1);
ini_set('display_errors', true);

use App\Controllers\HomeController;
use Doctrine\DBAL\DriverManager;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// auto loading
require __DIR__ . '/../vendor/autoload.php';

// environment variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

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

// database connection //TODO: abstract the connection
$connectionParams = [
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
    'host' => $_ENV['DB_HOST'],
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
];
$connection = DriverManager::getConnection($connectionParams);

$app->run();

//TODO: make constants file
//TODO: start with the login form