<?php
declare(strict_types=1);

namespace App\Controllers;

use App\RequestValidators\RequestValidatorFactory;
use App\RequestValidators\StudentRequestValidator;
use App\Services\StudentService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class StudentController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactory $requestValidatorFactory,
        private readonly StudentService $studentService,
        private readonly FacultyController $facultyController
    ){
    }

    public function form(Request $request, Response $response): Response {
        return $this->twig->render(
            $response,
            '/auth/registerStudent.twig',
            ['faculties' => $this->facultyController->getFacultyNames()]
        );
    }

    public function create(Request $request, Response $response): Response {
        $data = $request->getParsedBody();

        $validator = $this->requestValidatorFactory->make(StudentRequestValidator::class);
        $data = $validator->validate($data);

        $this->studentService->create($data);

        return $response->withHeader('Location','/')->withStatus(302);
    }
}