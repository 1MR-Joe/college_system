<?php
declare(strict_types=1);

// this file will return an array of key value pairs
// when the key is request, give the value or execute the function
// this array will be handed to the "CONTAINER BUILDER" class which supports an array of bindings as input

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Slim\Views\Twig;

return [
    EntityManager::class => fn() => new EntityManager(
        DriverManager::getConnection([ //TODO: make the config class and add this array to it
            'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
            'host' => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
        ]),
        ORMSetup::createAttributeMetadataConfiguration([__DIR__.'/../app/Entities'], isDevMode: true)
    ),
    Twig::class => function() {
        $twig = Twig::create(
            VIEWS_PATH, [
                'cache' => STORAGE_PATH . '/cache',
                'auto_reload' => true, //TODO: config class and abstract this true
            ]
        );

        //TODO: add any twig extensions here

        return $twig;
    } ,
];