<?php
declare(strict_types=1);

namespace App\Entities;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('courses')]
class Course
{
    #[Column, Id]
    private string $courseCode;
    #[Column]
    private string $courseName;
    #[Column]
    private int $level;
    #[Column]
    private int $creditHours;
    #[Column(type: Types::TEXT)]
    private string $description;
    #[OneToMany(targetEntity: Course::class)]
    private Collection $preRequests;

    public function __construct() {
        $this->preRequests = new ArrayCollection();
    }

    public function getCourseCode(): string
    {
        return $this->courseCode;
    }

    public function setCourseCode(string $courseCode): void
    {
        $this->courseCode = $courseCode;
    }

    public function getCourseName(): string
    {
        return $this->courseName;
    }

    public function setCourseName(string $courseName): void
    {
        $this->courseName = $courseName;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getCreditHours(): int
    {
        return $this->creditHours;
    }

    public function setCreditHours(int $creditHours): void
    {
        $this->creditHours = $creditHours;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPreRequests(): Collection
    {
        return $this->preRequests;
    }

    public function setPreRequests(Collection $preRequests): void
    {
        $this->preRequests = $preRequests;
    }

}