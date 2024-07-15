<?php
declare(strict_types=1);

namespace App\Controllers;

use App\RequestValidators\RegisterProfessorRequestValidator;
use App\RequestValidators\RequestValidatorFactory;
use App\Services\CollegeService;
use App\Services\ProfessorService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class ProfessorController
{
    public function __construct(
        private readonly Twig                    $twig,
        private readonly RequestValidatorFactory $requestValidatorFactory,
        private readonly CollegeService          $collegeService,
        private readonly ProfessorService        $professorService
    ){
    }

    public function form(Request $request, Response $response): Response {
        return $this->twig->render(
            $response,
            '/professor/registerProfessor.twig',
            ['faculties' => $this->collegeService->fetchCollegeNames()]
        );
    }

    public function create(Request $request, Response $response): Response {

        $data = $request->getParsedBody();

        $data = $this->requestValidatorFactory
            ->make(RegisterProfessorRequestValidator::class)
            ->validate($data);

        $this->professorService->create($data);

        // TODO: handle integrity constraints violation Exception (primary key)
        return $response->withHeader('Location', '/');
    }
}