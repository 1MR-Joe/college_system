<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\RequestValidators\RegisterCollegeRequestValidator;
use App\RequestValidators\RequestValidatorFactory;
use App\Services\CollegeService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Entities\College;
use Doctrine\ORM\EntityManager;
use RuntimeException;
use Slim\Views\Twig;

class CollegeController
{
    public function __construct(
        private readonly Twig                    $twig,
        private readonly RequestValidatorFactory $requestValidatorFactory,
        private readonly CollegeService          $collegeService,
    ){
    }

    public function form(Request $request, Response $response): Response {
        return $this->twig->render($response, '/college/registerCollege.twig');
    }
    public function create(Request $request, Response $response): Response {
        $data = $request->getParsedBody();

        $data = $this->requestValidatorFactory
            ->make(RegisterCollegeRequestValidator::class)
            ->validate($data);


        $this->collegeService->create($data);

        return $response->withHeader('Location', '/')->withStatus(302);
        // TODO: continue the controller functions
    }

    public function delete(Request $request, Response $response): Response {
        throw new RuntimeException("function not implemented");
    }
}