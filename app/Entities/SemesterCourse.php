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
    #[JoinColumn(name: 'course', referencedColumnName: 'code', onDelete: 'SET NULL')]
    private Course $course;

    #[Column(type: Types::STRING)]
    #[ManyToOne(targetEntity: Professor::class)]
    #[JoinColumn(name: 'professor', referencedColumnName: 'ssn', onDelete: 'SET NULL')]
    private Professor $professor;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): SemesterCourse
    {
        $this->id = $id;
        return $this;
    }

    public function getSemester(): Semester
    {
        return $this->semester;
    }

    public function setSemester(Semester $semester): SemesterCourse
    {
        $this->semester = $semester;
        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): SemesterCourse
    {
        $this->year = $year;
        return $this;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): SemesterCourse
    {
        $this->course = $course;
        return $this;
    }

    public function getProfessor(): Professor
    {
        return $this->professor;
    }

    public function setProfessor(Professor $professor): SemesterCourse
    {
        $this->professor = $professor;
        return $this;
    }

}