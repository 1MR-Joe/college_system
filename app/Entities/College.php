<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('college')]
class College
{
    #[Id, GeneratedValue, Column]
    private int $id;
    #[Column]
    private string $code;
    #[Column]
    private string $name;

    #[Column(name: 'college_year',type: Types::JSON)]
    // int year => int serialNumber
    private array $collegeYear;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): College
    {
        $this->id = $id;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): College
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): College
    {
        $this->name = $name;
        return $this;
    }

    public function getCollegeYears(): array {
        return $this->collegeYear;
    }

    public function initializeCollegeYearArray(): void {
        $this->collegeYear = [];
    }

    public function serialNumberExists(int $year): bool {
        return array_key_exists(strval($year), $this->collegeYear);
    }
    public function createSerialNumber(int $year): College {
        $this->collegeYear[strval($year)] = 1;
        return $this;
    }
    public function incrementSerialNumber(int $year): College {
        if($this->serialNumberExists($year)) {
            $this->collegeYear[strval($year)] += 1;
            return $this;

        } else {
            return $this->createSerialNumber($year);
        }
    }

    public function getSerialNumber(int $year): int {
        if(! $this->serialNumberExists($year)) {
            $this->createSerialNumber($year);
        }

        return $this->collegeYear[strval($year)];
    }

}