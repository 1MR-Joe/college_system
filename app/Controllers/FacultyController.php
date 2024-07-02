<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Faculty;
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