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
    #[JoinColumn(name: 'semester_course_id', referencedColumnName: 'id', onDelete: 'CASCADE')] //TODO: cascade until I can restrict
    private int $semesterCourseId;
    #[Column, Id]
    #[ManyToOne(targetEntity: Student::class)]
    #[JoinColumn(name: 'student_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private string $studentId;

    public function getGrade(): int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): void
    {
        $this->grade = $grade;
    }

    public function getSemesterCourseId(): int
    {
        return $this->semesterCourseId;
    }

    public function setSemesterCourseId(int $semesterCourseId): void
    {
        $this->semesterCourseId = $semesterCourseId;
    }

    public function getStudentId(): string
    {
        return $this->studentId;
    }

    public function setStudentId(string $studentId): void
    {
        $this->studentId = $studentId;
    }

}