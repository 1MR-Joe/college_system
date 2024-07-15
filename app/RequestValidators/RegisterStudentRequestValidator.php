<?php
declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Entities\College;
use App\Enums\Gender;
use App\Exceptions\ValidationException;
use App\Services\CollegeService;
use Doctrine\ORM\EntityManager;
use Valitron\Validator;

class RegisterStudentRequestValidator implements RequestValidatorInterface
{
    public function __construct(private readonly CollegeService $collegeService)
    {
    }

    public function validate(array $data): array
    {
        $v = new Validator($data);

        // add rules
        $v->rule(
            'required',
            [
                'firstName', 'lastName', 'ssn',
                'email' ,'phone', 'birthdate', 'gender',
                'college', 'password', 'confirmPassword'
            ]
        );
        $v->rule('optional', 'middleName');
        $v->rule('alpha', ['firstName', 'middleName', 'lastName']);
        $v->rule('numeric', ['phone', 'ssn']);
        $v->rule('email', 'email');
        $v->rule('length', 'ssn', 14);
        $v->rule('lengthMin', 'phone', 10);

        $v->rule('date', 'birthdate');
        //TODO: validate that the student is older than 17 years old

        $v->rule('equals', 'password', 'confirmPassword');
        // TODO: add regex for password rules checking
        // $v->rule('in', 'userType', ['student', 'professor']);

        // gender
        $v->rule('in', 'gender', ['male', 'female']);
        $data['gender'] = ($data['gender'] == 'male')? Gender::Male : Gender::Female;

        // college from id to object
        $v->rule(function($field, $value, $params, $fields) use (&$data){
            $id = (int) $value;
            if(! $id) {
                return false;
            }

            $college = $this->collegeService->fetchById($id);

            if($college === null) {
                return false;
            }

            $data['college'] = $college;
            return true;
        }, 'college')->message('College not found');

        // end of rules-------------------

        if(! $v->validate()) {
            throw new ValidationException($v->errors());
        }

        return $data;
    }
}