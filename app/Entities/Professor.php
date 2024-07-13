<?php
declare(strict_types=1);

namespace App\Entities;

use App\Enums\Gender;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('professors')]
class Professor
{
    #[Id, Column, GeneratedValue]
    private int $id;
    #[Column(unique: true)]
    private string $ssn;
    #[Column]
    private string $name;
    #[Column]
    private string $phone;
    #[Column]
    private Gender $gender;
    #[Column]
    private string $password;
    #[Column]
    private bool $isAdmin;
    #[ManyToOne(targetEntity: Faculty::class)]
    #[JoinColumn(onDelete: 'SET NULL')]
    private Faculty $faculty;

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

    public function getFaculty(): Faculty
    {
        return $this->faculty;
    }

    public function setFaculty(Faculty $faculty): void
    {
        $this->faculty = $faculty;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }
}