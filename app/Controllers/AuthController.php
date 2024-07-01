<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Student;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    public function __construct(
        private readonly Twig $twig,
    ){
    }

    public function loginView(Request $request, Response $response, array $args): Response {
        return $this->twig->render($response, 'auth/login.twig');
    }
    public function registerView(Request $request, Response $response, array $args): Response {
        return $this->twig->render($response, 'auth/register.twig');
    }

    public function loginUser(Request $request, Response $response, array $args): Response{
        var_dump($request->getParsedBody());
        return $response;
    }

    public function registerUser(Request $request, Response $response, array $args): Response{
        $data = $request->getParsedBody();
        var_dump($data);

        //TODO: where is the faculty ????????????????????????????????
        // add faculties
        // fetch them in registration form
        // associate the student with the chosen faculty

        if($data['userType'] == 'student') {
            $student = new Student($data);
            echo $student->getId();
        } else {
            //TODO: fill this part
            echo "";
        }

        return $response;
    }
}