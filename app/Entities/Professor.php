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
    #[Id, Column(options: ['unsigned'=> true]), GeneratedValue]
    private int $id;
    #[Column(unique: true)]
    private string $ssn;
    #[Column(name: 'first_name')]
    private string $firstName;
    #[Column(name: "middle_name", nullable: true)]
    private ?string $middleName;
    #[Column(name: 'last_name')]
    private string $lastName;
    #[Column]
    private string $phone;
    #[Column]
    private string $email;
    #[Column]
    private Gender $gender;
    #[Column]
    private string $password;
    #[Column]
    private bool $isAdmin;
    #[ManyToOne(targetEntity: College::class)]
    #[JoinColumn(onDelete: 'SET NULL')]
    private College $college;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSsn(): string
    {
        return $this->ssn;
    }

    public function setSsn(string $ssn): void
    {
        $this->ssn = $ssn;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): Professor
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): Professor
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): Professor
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Professor
    {
        $this->email = $email;
        return $this;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }

    public function setGender(Gender $gender): void
    {
        $this->gender = $gender;
    }

    public function getCollege(): College
    {
        return $this->college;
    }

    public function setCollege(College $college): void
    {
        $this->college = $college;
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