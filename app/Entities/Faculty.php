<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('faculty')]
class Faculty
{
    #[Id, GeneratedValue, Column]
    private int $id;
    #[Column]
    private string $code;
    #[Column]
    private string $name;

    #[Column(name: 'faculty_year',type: Types::JSON)]
    // int year => int serialNumber
    private array $facultyYear;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Faculty
    {
        $this->id = $id;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Faculty
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Faculty
    {
        $this->name = $name;
        return $this;
    }

    public function getFacultyYears(): array {
        return $this->facultyYear;
    }

    public function initializeFacultyYearArray(): void {
        $this->facultyYear = [];
    }

    public function serialNumberExists(int $year): bool {
        return array_key_exists(strval($year), $this->facultyYear);
    }
    public function createSerialNumber(int $year): Faculty {
        $this->facultyYear[strval($year)] = 1;
        return $this;
    }
    public function incrementSerialNumber(int $year): Faculty {
        if($this->serialNumberExists($year)) {
            $this->facultyYear[strval($year)] += 1;
            return $this;

        } else {
            return $this->createSerialNumber($year);
        }
    }

    public function getSerialNumber(int $year): int {
        if(! $this->serialNumberExists($year)) {
            $this->createSerialNumber($year);
        }

        return $this->facultyYear[strval($year)];
    }

}