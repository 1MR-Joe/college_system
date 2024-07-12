<?php
declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\FacultyController;
use App\Controllers\ProfessorController;
use App\Controllers\StudentController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use App\Controllers\HomeController;

return function(App $app) {
    $app->get('/', [HomeController::class, 'index']);

    // $app->get('/login', [AuthController::class, 'loginView']);
    // $app->get('/register', [AuthController::class, 'registerView']);

    // $app->post('/login', [AuthController::class, 'loginUser']);
    // $app->post('/register', [AuthController::class, 'registerUser']);

    $app->get('/student/form', [StudentController::class, 'form']);
    $app->post('/student/create', [StudentController::class, 'create']);


    $app->get('/professor/form', [ProfessorController::class, 'form']);
    $app->post('/professor/create', [ProfessorController::class, 'create']);

    $app->get('/faculty/form', [FacultyController::class, 'form']);
    $app->post('/faculty/create', [FacultyController::class, 'create']);
};