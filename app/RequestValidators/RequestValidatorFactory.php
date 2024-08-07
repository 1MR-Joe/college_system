<?php
declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\RequestValidatorInterface;
use http\Exception\RuntimeException;
use Psr\Container\ContainerInterface;

class RequestValidatorFactory implements RequestValidatorFactoryInterface
{
    public function __construct(private readonly ContainerInterface $container)
    {
    }

    public function make(string $class): RequestValidatorInterface
    {
        $validator = $this->container->get($class);

        if(! $validator instanceof RequestValidatorInterface) {
            throw new RuntimeException("unable to resolve this request validator");
        }

        return $validator;
    }
}