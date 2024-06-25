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
}