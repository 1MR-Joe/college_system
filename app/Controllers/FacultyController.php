<?php
declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Entities\Faculty;
use Doctrine\ORM\EntityManager;
use http\Exception\RuntimeException;
use Slim\Views\Twig;

class FacultyController
{
    public function __construct(
        private readonly EntityManager $entityManager,
        private readonly Twig $twig,
    ){
    }

    public function form(Request $request, Response $response): Response {
        return $this->twig->render($response, '/faculty/registerFaculty.twig');
    }
    public function create(Request $request, Response $response): Response {
        throw new RuntimeException("function not implemented");

        // TODO: createFacultyRequestValidator
        // TODO: continue the controller functions
    }

    public function delete(Request $request, Response $response): Response {
        throw new RuntimeException("function not implemented");
    }

    public function getFacultyNames(): array
    {
        return $this->entityManager
            ->getRepository(Faculty::class)
            ->createQueryBuilder('f')
            ->select('f.id', 'f.name')
            ->getQuery()
            ->getArrayResult();
    }
}