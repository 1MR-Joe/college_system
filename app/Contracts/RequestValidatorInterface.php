<?php
declare(strict_types=1);

namespace App\Contracts;

// added this interface to be able to make a request validator as a return type of the request validator factory

interface RequestValidatorInterface
{
    public function validate(array $data): array;
}