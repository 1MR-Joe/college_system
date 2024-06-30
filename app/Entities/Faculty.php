<?php
declare(strict_types=1);

namespace App\Entities;

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
}