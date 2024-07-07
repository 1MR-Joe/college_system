<?php
declare(strict_types=1);

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\Twig;

class OldFormDataMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly Twig $twig)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if(! empty($_SESSION['oldData'])) {
            $this->twig->getEnvironment()->addGlobal('oldData', $_SESSION['oldData']);
            unset($_SESSION['oldData']);
        }

        return $handler->handle($request);
    }
}