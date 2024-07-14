<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Student;
use DateTime;
use Doctrine\ORM\EntityManager;

class StudentService
{
    public function __construct(
        private readonly EntityManager $entityManager,
        private readonly FacultyService $facultyService
    ){
    }

    public function create(array $data): Student {
        $student = new Student();
        $student->setFirstName($data['firstName']);

        if($data['middleName']) {//TODO: better way ??
            $student->setMiddleName($data['middleName']);
        }

        $student->setLastName($data['lastName']);
        $student->setSsn($data['ssn']);
        $student->setEmail($data['email']);
        $student->setPhone($data['phone']);
        $student->setGender($data['gender']);
        $student->setFaculty($data['faculty']);
        $student->setBirthdate(new DateTime($data['birthdate']));
        $student->setPassword(password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]));

        $this->completeCredentials($student);

        $this->entityManager->persist($student);
        $this->entityManager->flush();

        return $student;
    }

    public function fetchById(string $id): Student|null {
        return $this->entityManager->getRepository(Student::class)->findOneBy(['id' => $id]);
    }

    public function fetchByName(string $firstName = '', string $middleName = '', string $lastName = ''): array {
        $query = $this->entityManager
            ->getRepository(Student::class)
            ->createQueryBuilder('s')
            ->select();

        if($firstName) {
            $query
                ->where('s.firstName LIKE :firstName')
                ->setParameter('firstName', $firstName);
        }

        if($middleName) {
            $query
                ->andWhere('s.middleName LIKE :middleName')
                ->setParameter('middleName', $middleName);
        }

        if($lastName) {
            $query
                ->andWhere('s.lastName LIKE :lastName')
                ->setParameter('lastName', $lastName);
        }

        return $query->getQuery()->getArrayResult();
    }

    public function fetchAll(): array {
        return $this->entityManager->getRepository(Student::class)->findAll();
    }

    public function updatePhone(Student $student, string $newPhoneNumber): Student {
        //TODO: when scaling this feature, add request validation

        $student->setPhone($newPhoneNumber);
        $this->entityManager->persist($student);
        $this->entityManager->flush();

        return $student;
    }

    public function delete(string $id): void {
        $student = $this->entityManager->find(Student::class, $id);
        // TODO: the find method can throw an exception, shouldn't that be handled ??

        $this->entityManager->remove($student);
        $this->entityManager->flush();
    }

    public function completeCredentials(Student $student): Student {
        // admission year and gpa handling
        $today = new DateTime('now');
        $student->setAdmissionYear((int) $today->format('Y'));
        $student->setGpa(4);

        // id handling
        // id = admissionYear + facultyId + serialNumber
        $facultyId = strval($student->getFaculty()->getId());
        if(strlen($facultyId) == 1) {
            $facultyId = '0'.$facultyId;
        }

        $serialNumber = strval($student->getFaculty()->getSerialNumber($student->getAdmissionYear()));
        switch(strlen($serialNumber)){
            case 1:
                $serialNumber = '00'.$serialNumber;
                break;
            case 2:
                $serialNumber = '0'.$serialNumber;
                break;
        }

        $student->setId($today->format('y') . $facultyId . $serialNumber);
        $this->facultyService->incrementSerialNumber($student->getFaculty(), $student->getAdmissionYear());

        return $student;
    }
}