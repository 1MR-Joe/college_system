<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Entities\College;
use App\Entities\Student;
use App\Enums\Gender;
use App\RequestValidators\RequestValidatorFactory;
use App\RequestValidators\RegisterStudentRequestValidator;
use App\Services\StudentService;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    public function __construct(
        private readonly Twig                    $twig,
        private readonly EntityManager           $entityManager,
        private readonly RequestValidatorFactory $requestValidatorFactory,
        private readonly CollegeController       $facultyController,
    ){
    }

    public function loginView(Request $request, Response $response, array $args): Response {
        return $this->twig->render($response, 'auth/login.twig');
    }
    public function registerView(Request $request, Response $response, array $args): Response {
        return $this->twig->render(
            $response,
            '/student/registerStudent.twig',
            ['faculties' => $this->facultyController->getFacultyNames()]
        );
    }

    public function loginUser(Request $request, Response $response, array $args): Response{
        var_dump($request->getParsedBody());
        return $response;
    }

    public function registerUser(Request $request, Response $response, array $args): Response{
        // take inputs
        $data = $request->getParsedBody();
        var_dump($data);

        echo 'validating student'; echo "<br>";

        $validator = $this->requestValidatorFactory->make(RegisterStudentRequestValidator::class);
        $validator->validate($data);
        //TODO: validate data
        // replace college id with the true instance
        // plug in the array
        // remove the automatic college setting part

        $student = new Student();
        $student->setName($data['name']);
        $student->setSsn($data['ssn']);
        $student->setPhone($data['phone']);
        $student->setGender($data['gender']);
        $student->setCollege($data['college']);
        $student->setBirthdate(new \DateTime($data['birthdate']));
        $student->setPassword(password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]));

        $student->completeCredentials();

        $this->entityManager->persist($student);
        $this->entityManager->flush();

        return $response;
    }
}