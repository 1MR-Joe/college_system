<?php
declare(strict_types=1);

namespace App\Entities;

use App\Enums\Semester;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
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
    #[Column(type: Types::STRING)]
    #[ManyToOne(targetEntity: Course::class)]
    #[JoinColumn(name: 'course_code', referencedColumnName: 'code', onDelete: 'SET NULL')]
    private string $courseCode;

    #[Column(type: Types::STRING)]
    #[ManyToOne(targetEntity: Professor::class)]
    #[JoinColumn(name: 'professor_ssn', referencedColumnName: 'ssn', onDelete: 'SET NULL')]
    private string $professorSsn;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getSemester(): Semester
    {
        return $this->semester;
    }

    public function setSemester(Semester $semester): void
    {
        $this->semester = $semester;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getCourseCode(): string
    {
        return $this->courseCode;
    }

    public function setCourseCode(string $courseCode): void
    {
        $this->courseCode = $courseCode;
    }

    public function getProfessorSsn(): string
    {
        return $this->professorSsn;
    }

    public function setProfessorSsn(string $professorSsn): void
    {
        $this->professorSsn = $professorSsn;
    }

}