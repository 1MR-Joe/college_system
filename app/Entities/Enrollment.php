<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'enrollments')]
class Enrollment
{
    #[Column]
    private int $grade;

    // foreign keys
    #[Column, Id]
    #[ManyToOne(targetEntity: SemesterCourse::class)]
    #[JoinColumn(name: 'semester_course', referencedColumnName: 'id', onDelete: 'CASCADE')] //TODO: cascade until I can restrict
    private SemesterCourse $semesterCourse;
    #[Column, Id]
    #[ManyToOne(targetEntity: Student::class)]
    #[JoinColumn(name: 'student', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Student $student;

    public function getGrade(): int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): Enrollment
    {
        $this->grade = $grade;
        return $this;
    }

    public function getSemesterCourse(): SemesterCourse
    {
        return $this->semesterCourse;
    }

    public function setSemesterCourse(SemesterCourse $semesterCourse): Enrollment
    {
        $this->semesterCourse = $semesterCourse;
        return $this;
    }

    public function getStudent(): Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): Enrollment
    {
        $this->student = $student;
        return $this;
    }

}