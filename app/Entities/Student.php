<?php
declare(strict_types=1);

namespace App\Entities;

use App\Enums\Gender;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('students')]
class Student
{
    #[Id, Column]
    private string $id;
    #[Column]
    private string $ssn;
    #[Column]
    private string $name;
    #[Column(type: Types::DECIMAL)]//TODO: precision and scale ??
    private float $gpa;
    #[Column]
    private string $phone;
    #[Column]
    private Gender $gender;
    #[Column]
    private \DateTime $birthdate;
    #[Column]
    private int $admissionYear;
    #[ManyToOne(targetEntity: Faculty::class)]
    #[JoinColumn(name: 'faculty_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Faculty $faculty;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getSsn(): string
    {
        return $this->ssn;
    }

    public function setSsn(string $ssn): void
    {
        $this->ssn = $ssn;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGpa(): float
    {
        return $this->gpa;
    }

    public function setGpa(float $gpa): void
    {
        $this->gpa = $gpa;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }

    public function setGender(Gender $gender): void
    {
        $this->gender = $gender;
    }

    public function getBirthdate(): \DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function getAdmissionYear(): int
    {
        return $this->admissionYear;
    }

    public function setAdmissionYear(int $admissionYear): void
    {
        $this->admissionYear = $admissionYear;
    }

    public function getFaculty(): Faculty
    {
        return $this->faculty;
    }

    public function setFaculty(Faculty $faculty): void
    {
        $this->faculty = $faculty;
    }


    //TODO: add constructor
}