<?php
declare(strict_types=1);

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\Twig;

/**
 * loads the errors array to the global environment of twig
 */

class ValidationErrorMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly Twig $twig)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if(! empty($_SESSION['errors'])) {
            $this->twig->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

        return $handler->handle($request);
        //TODO: upgrade this middleware
        // make this middleware handle any exception after a form was submitted
        // not just validation exception
        // so it saves the data in case any exception happens
    }
}