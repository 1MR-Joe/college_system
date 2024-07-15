<?php
declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Exceptions\ValidationException;
use Valitron\Validator;

class RegisterCollegeRequestValidator implements RequestValidatorInterface
{

    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', ['name', 'code']);

        $v->rule('alpha', 'code');
        $v->rule('regex', 'name', '/([A-Za-z ])$/');

        $v->rule('lengthMin', 'name', 3);
        $v->rule('lengthMax', 'code', 4);

        if(! $v->validate()) {
            throw new ValidationException($v->errors());
        }

        return $data;
    }
}