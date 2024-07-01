<?php
declare(strict_types=1);

namespace App\Controllers;

use Doctrine\ORM\EntityManager;

class FacultyController
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function createFaculty() {

    }

    public function deleteFaculty() {

    }
}