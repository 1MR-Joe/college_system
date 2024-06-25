<?php
declare(strict_types=1);

namespace App\Entities;

use App\Enums\Semester;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('semester_course')]
class SemesterCourse
{
    #[Id, GeneratedValue, Column]
    private string $id;
    #[Column]
    private Semester $semester;
    #[Column]
    private int $year;
}