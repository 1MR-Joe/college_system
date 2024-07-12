<?php
declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Enums\Gender;
use App\Exceptions\ValidationException;
use App\Services\FacultyService;
use Valitron\Validator;

class RegisterProfessorRequestValidator implements RequestValidatorInterface
{
    public function __construct(private readonly FacultyService $facultyService)
    {
    }

    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule(
            'required',
            [
                'name','ssn', 'phone', 'gender',
                'faculty', 'password', 'confirmPassword',
            ]
        );
        $v->rule('alpha', 'name');
        $v->rule('numeric', ['phone', 'ssn']);
        $v->rule('length', 'ssn', 14);
        $v->rule('lengthMin', 'phone', 10);
        $v->rule('equals', 'password', 'confirmPassword');
        // TODO: add regex for password rules checking

        // gender
        $v->rule('in', 'gender', ['male', 'female']);
        $data['gender'] = ($data['gender'] == 'male')? Gender::Male : Gender::Female;

        // faculty from id to object
        $v->rule(function($field, $value, $params, $fields) use (&$data){
            $id = (int) $value;
            if(! $id) {
                return false;
            }

            $faculty = $this->facultyService->fetchById($id);

            if($faculty === null) {
                return false;
            }

            $data['faculty'] = $faculty;
            return true;
        }, 'faculty')->message('Faculty not found');

        // end of rules-------------------

        if(! $v->validate()) {
            throw new ValidationException($v->errors());
        }

        return $data;
    }
}