<?php
declare(strict_types=1);
namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
class HomeController
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function index(Request $request, Response $response, $args) {
        return Twig::fromRequest($request)->render($response, 'index.twig');
    }
}