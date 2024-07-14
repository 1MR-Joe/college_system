<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Professor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Parameter;
use Invoker\ParameterResolver\Container\ParameterNameContainerResolver;

class ProfessorService
{
    public function __construct(
        private readonly EntityManager $entityManager,
    ){
    }

    public function create(array $data): Professor {
        $prof = new Professor();
        $prof->setFirstName($data['firstName']);

        if($data['middleName']) {
            $prof->setMiddleName($data['middleName']);
        }

        $prof->setLastName($data['lastName']);
        $prof->setSsn($data['ssn']);
        $prof->setEmail($data['email']);
        $prof->setPhone($data['phone']);
        $prof->setGender($data['gender']);
        $prof->setFaculty($data['faculty']);
        $prof->setIsAdmin(false);
        $prof->setPassword(password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]));

        $this->entityManager->persist($prof);
        $this->entityManager->flush();

        return $prof;
    }

    public function fetchById(int $id): Professor|null {
        return $this->entityManager->getRepository(Professor::class)->findOneBy(['id' => $id]);
    }

    public function fetchByName(string $firstName = '', string $middleName = '', string $lastName = ''): array {
        $query = $this->entityManager
            ->getRepository(Professor::class)
            ->createQueryBuilder('p')
            ->select();

        if($firstName) {
            $query
                ->where('p.firstName LIKE :firstName')
                ->setParameter('firstName', $firstName);
        }

        if($middleName) {
            $query
                ->andWhere('p.middleName LIKE :middleName')
                ->setParameter('middleName', $middleName);
        }

        if($lastName) {
            $query
                ->andWhere('p.lastName LIKE :lastName')
                ->setParameter('lastName', $lastName);
        }

        return $query->getQuery()->getArrayResult();
    }

    public function fetchAll(): array {
        return $this->entityManager->getRepository(Professor::class)->findAll();
    }

    public function updatePhone(Professor $prof, string $newPhoneNumber): Professor {
        //TODO: when scaling this feature, add request validation

        $prof->setPhone($newPhoneNumber);
        $this->entityManager->persist($prof);
        $this->entityManager->flush();

        return $prof;
    }

    public function delete(int $id): void {
        $prof = $this->entityManager->find(Professor::class, $id);
        // TODO: the find method can throw an exception, shouldn't that be handled ??

        $this->entityManager->remove($prof);
        $this->entityManager->flush();
    }
}