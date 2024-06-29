<?php
declare(strict_types=1);

// this file will return an array of key value pairs
// when the key is request, give the value or execute the function
// this array will be handed to the "CONTAINER BUILDER" class which supports an array of bindings as input

use App\Config;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Slim\Views\Twig;

return [
    Config::class => fn() => new Config($_ENV),
    EntityManager::class => function(Config $config) {
        $connection = DriverManager::getConnection($config->get('db'));

        $ormSetup = ORMSetup::createAttributeMetadataConfiguration([__DIR__.'/../app/Entities'], isDevMode: true); //TODO: use config class to abstract this

        return new EntityManager($connection, $ormSetup);
    } ,
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