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
    #[Column(name: 'first_name')]
    private string $firstName;
    #[Column(name: 'middle_name', nullable: true)]
    private ?string $middleName;
    #[Column(name: 'last_name')]
    private string $lastName;
    #[Column(type: Types::FLOAT)]
    private float $gpa;
    #[Column]
    private string $phone;
    #[Column]
    private string $email;
    #[Column]
    private Gender $gender;//TODO: make the DB allow only some values
    #[Column]
    private \DateTime $birthdate;
    #[Column]
    private int $admissionYear;
    #[Column]
    private string $password;
    #[ManyToOne(targetEntity: College::class)]
    #[JoinColumn(name: 'college', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private College $college;

    //TODO: fluent setters please
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

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): Student
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): Student
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): Student
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getGpa(): float
    {
        return $this->gpa;
    }
    //TODO: setGpa function; it should make some calculations
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Student
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


    public function __construct(){
    }
}