<?php
declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Entities\Faculty;
use App\Enums\Gender;
use App\Exceptions\ValidationException;
use Doctrine\ORM\EntityManager;
use Valitron\Validator;

class StudentRequestValidator implements RequestValidatorInterface
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function validate(array $data): array
    {
        $v = new Validator($data);

        // add rules
        $v->rule('required', array_keys($data));
        $v->rule('equals', 'password', 'confirmPassword');
        $v->rule('length', 'ssn', 14);
        $v->rule('lengthMin', 'phone', 10);
        $v->rule('alpha', 'name');
        // $v->rule('in', 'userType', ['student', 'professor']);
        $v->rule('date', 'birthdate');

        // gender
        $v->rule('in', 'gender', ['male', 'female']);
        $data['gender'] = ($data['gender'] == 'male')? Gender::Male : Gender::Female;

        // faculty from id to object
        $v->rule(function($field, $value, $params, $fields) use (&$data){
            $id = (int) $value;
            if(! $id) {
                return false;
            }

            // TODO: abstract to FacultyService !!
            $faculty = $this->entityManager->find(Faculty::class, $id) ?? null;

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