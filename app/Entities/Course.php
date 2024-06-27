<?php
declare(strict_types=1);

namespace App\Entities;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('courses')]
class Course
{
    #[Column, Id]
    #[ManyToOne(inversedBy: 'pre_requests')]
    private string $code;
    #[Column]
    private string $name;
    #[Column]
    private int $level;
    #[Column(name: 'credit_hours')]
    private int $creditHours;
    #[Column(type: Types::TEXT)]
    private string $description;
    #[OneToMany(targetEntity: Course::class, mappedBy: 'code')]
    #[JoinColumn(name: 'pre_requests')]
    private Collection $preRequests;
    #[OneToMany(targetEntity: Faculty::class, mappedBy: 'id')]
    private Collection $offeringFaculties;
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

    public function getOfferingFaculties(): Collection
    {
        return $this->offeringFaculties;
    }

    public function setOfferingFaculties(Collection $offeringFaculties): void
    {
        $this->offeringFaculties = $offeringFaculties;
    }
}