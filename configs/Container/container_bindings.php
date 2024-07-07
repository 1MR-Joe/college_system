<?php
declare(strict_types=1);

// this file will return an array of key value pairs
// when the key is request, give the value or execute the function
// this array will be handed to the "CONTAINER BUILDER" class which supports an array of bindings as input

use App\Config;
use App\Contracts\RequestValidatorFactoryInterface;
use App\RequestValidators\RequestvalidatorFactory;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

return [
    App::class => function(ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // register routes
        $router = require CONFIGS_PATH . '/routes.php';
        $router($app);

        // register middlewares
        $middleware = require(CONFIGS_PATH . '/middleware.php');
        $middleware($app);

        // configuration done
        return $app;
    },
    Config::class => fn() => new Config($_ENV),
    EntityManager::class => function (Config $config) {
        $connection = DriverManager::getConnection($config->get('db'));

        $ormSetup = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/../app/Entities'],
            isDevMode: ($config->get('environment') === 'development')
        );

        return new EntityManager($connection, $ormSetup);
    },
    Twig::class => function (Config $config) {
        $twig = Twig::create(
            VIEWS_PATH, [
                'cache' => STORAGE_PATH . '/cache',
                'auto_reload' => ($config->get('environment') === 'development'),
            ]
        );

        //TODO: add any twig extensions here

        return $twig;
    },
    RequestValidatorFactoryInterface::class => fn(ContainerInterface $container) => $container->get(
        RequestvalidatorFactory::class
    ),
    ResponseFactoryInterface::class => fn(App $app) => $app->getResponseFactory(),

];