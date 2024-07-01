<?php
declare(strict_types=1);

namespace App\Entities;

use App\Enums\Gender;
use Cassandra\Date;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManager;
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
    #[Column(type: Types::DECIMAL, precision: 2, scale: 2)]
    private float $gpa;
    #[Column]
    private string $phone;
    #[Column]
    private Gender $gender;
    #[Column]
    private \DateTime $birthdate;
    #[Column]
    private int $admissionYear;
    #[Column]
    private string $password;
    #[ManyToOne(targetEntity: Faculty::class)]
    #[JoinColumn(name: 'faculty', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Faculty $faculty;

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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function __construct(array $data){
        // take inputs
        // TODO: assuming data is validated
        $this->setName($data['name']);
        $this->setSsn($data['ssn']);
        $this->setFaculty($data['faculty']);
        $this->setPhone($data['phone']);
        $this->setBirthdate(new \DateTime($data['birthdate']));
        $this->setPassword(password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]));

        // admission year and gpa handling
        $today = new \DateTime('now');
        $this->admissionYear = (int) $today->format('Y');
        $this->gpa = 4;

        // id handling
        // Id = admissionYear + facultyId + serialNumber
        $facultyId = strval($this->faculty->getId());
        if(strlen($facultyId) == 1) {
            $facultyId = '0'.$facultyId;
        }

        $serialNumber = strval($this->faculty->getSerialNumber($this->admissionYear));
        switch(strlen($serialNumber)){
            case 1:
                $serialNumber = '00'.$serialNumber;
            break;
            case 2:
                $serialNumber = '0'.$serialNumber;
            break;
        }

        $this->id = $today->format('y') . $facultyId . $serialNumber;
        $this->faculty->updateSerialNumber($this->admissionYear);

    }
}