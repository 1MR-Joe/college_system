<?php
declare(strict_types=1);

use App\Middlewares\OldFormDataMiddleware;
use App\Middlewares\StartSessionMiddleware;
use App\Middlewares\ValidationErrorMiddleware;
use App\Middlewares\ValidationExceptionMiddleware;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function(App $app) {
    $container = $app->getContainer();

    // Twig
    $app->add(TwigMiddleware::create($app, $container->get(Twig::class)));
    $app->add(ValidationExceptionMiddleware::class);
    $app->add(ValidationErrorMiddleware::class);
    $app->add(OldFormDataMiddleware::class);
    $app->add(StartSessionMiddleware::class);
};