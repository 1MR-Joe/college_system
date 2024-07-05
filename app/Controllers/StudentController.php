<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Student;
use App\RequestValidators\RequestValidatorFactory;
use App\RequestValidators\StudentRequestValidator;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class StudentController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactory $requestValidatorFactory,
        private readonly EntityManager $entityManager,
        private readonly FacultyController $facultyController
    ){
    }

    public function form(Request $request, Response $response, array $args): Response {
        return $this->twig->render(
            $response,
            '/auth/registerStudent.twig',
            ['faculties' => $this->facultyController->getFacultyNames()]
        );
    }

    public function register(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();

        $validator = $this->requestValidatorFactory->make(StudentRequestValidator::class);
        $data = $validator->validate($data);

        $student = new Student();
        $student->setName($data['name']);
        $student->setSsn($data['ssn']);
        $student->setPhone($data['phone']);
        $student->setGender($data['gender']);
        $student->setFaculty($data['faculty']);
        $student->setBirthdate(new \DateTime($data['birthdate']));
        $student->setPassword(password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]));

        $student->completeCredentials();

        $this->entityManager->persist($student);
        $this->entityManager->flush();

        return $response->withHeader('Location','/')->withStatus(302);
    }
}