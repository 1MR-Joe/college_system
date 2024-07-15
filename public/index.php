<?php
declare(strict_types=1);
ini_set('display_errors', true);

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Slim\App;

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

/** @var ContainerInterface $container */
$container = require CONFIGS_PATH . '/Container/container.php';

// create app
// app creation logic was moved to container bindings so that the app can be constructor injected
$app = $container->get(App::class);

$app->run();


/** @var EntityManager $em */
$em = $container->get(EntityManager::class);
$service = new \App\Services\StudentService($em, new \App\Services\CollegeService($em));

// TODO: define entry points and hierarchy
