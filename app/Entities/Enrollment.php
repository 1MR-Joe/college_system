<?php
declare(strict_types=1);

namespace App\Entities;

class Enrollment
{
    private int $grade;

    // foreign keys
    private int $semesterCourseId;
    private string $studentId;
}