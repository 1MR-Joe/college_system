<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\RequestValidators\RegisterFacultyRequestValidator;
use App\RequestValidators\RequestValidatorFactory;
use App\Services\FacultyService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Entities\Faculty;
use Doctrine\ORM\EntityManager;
use RuntimeException;
use Slim\Views\Twig;

class FacultyController
{
    public function __construct(
        private readonly EntityManager $entityManager,
        private readonly Twig $twig,
        private readonly RequestValidatorFactory $requestValidatorFactory,
        private readonly FacultyService $facultyService,
    ){
    }

    public function form(Request $request, Response $response): Response {
        return $this->twig->render($response, '/faculty/registerFaculty.twig');
    }
    public function create(Request $request, Response $response): Response {
        $data = $request->getParsedBody();

        $data = $this->requestValidatorFactory
            ->make(RegisterFacultyRequestValidator::class)
            ->validate($data);


        $this->facultyService->create($data);

        return $response->withHeader('Location', '/')->withStatus(302);
        // TODO: continue the controller functions
    }

    public function delete(Request $request, Response $response): Response {
        throw new RuntimeException("function not implemented");
    }
}