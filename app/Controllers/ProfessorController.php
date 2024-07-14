<?php
declare(strict_types=1);

namespace App\Controllers;

use App\RequestValidators\RegisterProfessorRequestValidator;
use App\RequestValidators\RequestValidatorFactory;
use App\Services\FacultyService;
use App\Services\ProfessorService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class ProfessorController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactory $requestValidatorFactory,
        private readonly FacultyService $facultyService,
        private readonly ProfessorService $professorService
    ){
    }

    public function form(Request $request, Response $response): Response {
        return $this->twig->render(
            $response,
            '/professor/registerProfessor.twig',
            ['faculties' => $this->facultyService->fetchFacultyNames()]
        );
    }

    public function create(Request $request, Response $response): Response {

        $data = $request->getParsedBody();

        $data = $this->requestValidatorFactory
            ->make(RegisterProfessorRequestValidator::class)
            ->validate($data);

        $this->professorService->create($data);
        // TODO: test professor service

        // TODO: handle integrity constraints violation (primary key)
        return $response->withHeader('Location', '/');
    }
}