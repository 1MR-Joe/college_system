<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Professor;
use Doctrine\ORM\EntityManager;

class ProfessorService
{
    public function __construct(
        private readonly EntityManager $entityManager,
    ){
    }

    public function create(array $data): Professor {
        $prof = new Professor();
        $prof->setName($data['name']);
        $prof->setSsn($data['ssn']);
        $prof->setPhone($data['phone']);
        $prof->setGender($data['gender']);
        $prof->setFaculty($data['faculty']);
        $prof->setIsAdmin(false);
        $prof->setPassword(password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]));

        $this->entityManager->persist($prof);
        $this->entityManager->flush();

        return $prof;
    }

    public function fetchById(string $id): Professor|null {
        return $this->entityManager->getRepository(Professor::class)->findOneBy(['id' => $id]);
    }

    public function fetchByName(string $name): array {
        return $this->entityManager
            ->getRepository(Professor::class)
            ->createQueryBuilder('p')
            ->select()
            ->where('p.name LIKE :name')
            ->setParameter(':name', $name)
            ->getQuery()
            ->getArrayResult();
    }

    public function fetchAll() {
        return $this->entityManager->getRepository(Professor::class)->findAll();
    }

    public function updatePhone(Professor $prof, string $newPhoneNumber) {
        //TODO: when scaling this feature, add request validation

        $prof->setPhone($newPhoneNumber);
        $this->entityManager->persist($prof);
        $this->entityManager->flush();

        return $prof;
    }

    public function delete(string $id) {
        $prof = $this->entityManager->find(Professor::class, $id);
        // TODO: the find method can throw an exception, shouldn't that be handled ??

        $this->entityManager->remove($prof);
        $this->entityManager->flush();
    }
}