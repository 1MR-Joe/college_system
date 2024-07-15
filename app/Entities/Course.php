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
    #[OneToMany(targetEntity: College::class, mappedBy: 'id')]
    private Collection $offeringColleges;
    public function __construct() {
        $this->preRequests = new ArrayCollection();
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $courseCode): void
    {
        $this->code = $courseCode;
    }

    public function getCourseName(): string
    {
        return $this->name;
    }

    public function setCourseName(string $courseName): void
    {
        $this->name = $courseName;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): Course
    {
        $this->level = $level;

        return $this;
    }

    public function getCreditHours(): int
    {
        return $this->creditHours;
    }

    public function setCreditHours(int $creditHours): Course
    {
        $this->creditHours = $creditHours;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Course
    {
        $this->description = $description;

        return $this;
    }

    public function getPreRequests(): Collection
    {
        return $this->preRequests;
    }

    public function addPreRequest(Course $preRequest): Course
    {
        $this->preRequests->add($preRequest);

        return $this;
    }

    public function getOfferingColleges(): Collection
    {
        return $this->offeringColleges;
    }

    public function addOfferingColleges(College $college): Course
    {
        $this->offeringColleges->add($college);

        return $this;
    }
}