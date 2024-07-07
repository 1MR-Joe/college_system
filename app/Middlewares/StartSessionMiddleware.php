<?php
declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\SessionException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class StartSessionMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
        // if session is already started => error
        if(session_status() === PHP_SESSION_ACTIVE){
            throw new SessionException("Session already started!");

        }

        // if headers are sent => error
        if(headers_sent($filename, $line)) {
            throw new SessionException("Headers are already sent!");
        }

        // start session
        session_start();

        // handle the request
        $response = $handler->handle($request);

        // end the session
        session_write_close();

        return $response;
    }
}