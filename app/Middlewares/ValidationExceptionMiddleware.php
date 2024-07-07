<?php
declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\ValidationException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * catches Validation Exception and redirects the user to the form that thrown that thrown the exception
 */

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly ResponseFactoryInterface $responseFactory
    ){
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try{ // handle the request

            return $handler->handle($request);

        } catch (ValidationException $e) { // catch any validation exception

            $_SESSION['errors'] = $e->errors;

            // store old form data
            $oldData = $request->getParsedBody();

            $sensitiveData = ['password', 'confirmPassword'];

            $_SESSION['oldData'] = array_diff_key($oldData, array_flip($sensitiveData));

            $response = $this->responseFactory->createResponse();
            $referer = $request->getServerParams()['HTTP_REFERER'];

            return $response->withHeader('Location', $referer)->withStatus(302);
        }

    }
}