<?php
declare(strict_types=1);
namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
class HomeController
{
    public function __construct(private readonly Twig $twig)
    {
    }

    public function index(Request $request, Response $response, $args) {
        // $_SESSION['counter'] = ($_SESSION['counter'] ?? 0) + 1;

        echo $_SESSION['counter']; echo "<br>";
        return $this->twig->render($response, 'dashboard.twig'); //TODO: add if else to handle both entities
    }
}