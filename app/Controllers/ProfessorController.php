<?php
declare(strict_types=1);

namespace App\Controllers;

use App\RequestValidators\RegisterProfessorRequestValidator;
use App\RequestValidators\RequestValidatorFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class ProfessorController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactory $requestValidatorFactory
    ){
    }

    public function form(Request $request, Response $response): Response {
        return $this->twig->render($response, '/auth/registerProfessor.twig');
    }

    public function create(Request $request, Response $response): Response {

        $data = $request->getParsedBody();

        $this->requestValidatorFactory
            ->make(RegisterProfessorRequestValidator::class)
            ->validate($data);

        return $response->withHeader('Location', '/');
    }
}