<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Faculty;
use Doctrine\ORM\EntityManager;

class FacultyService
{
    public function __construct(
        private readonly EntityManager $entityManager,
    ){
    }

    public function create(array $data): Faculty {
        // TODO: test this function
        $faculty = new Faculty();

        $faculty->setId((int) $data['id']);
        $faculty->setName($data['name']);
        $faculty->setCode($data['code']);
        $faculty->initializeFacultyYearArray();
        $year = (new \DateTime('now'))->format('Y');
        $faculty->createSerialNumber((int) $year);

        $this->entityManager->persist($faculty);
        $this->entityManager->flush();

        return $faculty;
    }

    public function fetchById(int $id) {
        return $this->entityManager->getRepository(Faculty::class)->findOneBy(['id' => $id]);
    }

    public function fetchByName(string $name): array {
        $qb = $this->entityManager->getRepository(Faculty::class)->createQueryBuilder('f');
        return $qb
            ->select()
            ->where($qb->expr()->like('f.name', $qb->expr()->literal('%'.$name.'%')))
            ->getQuery()
            ->getArrayResult();
    }

    public function fetchAll() {
        // TODO: test this function
        return $this->entityManager->getRepository(Faculty::class)->findAll();
    }

    public function updateName(Faculty $faculty, string $newName) {
        $faculty->setName($newName);

        $this->entityManager->persist($faculty);
        $this->entityManager->flush();

        return $faculty;
    }

    public function updateCode(Faculty $faculty, string $newCode) {
        $faculty->setCode($newCode);

        $this->entityManager->persist($faculty);
        $this->entityManager->flush();

        return $faculty;
    }

    public function incrementSerialNumber(Faculty $faculty, int $year): Faculty {
        $faculty = $faculty->incrementSerialNumber($year);

        $this->entityManager->persist($faculty);
        $this->entityManager->flush();

        return $faculty;
    }

    public function delete(int $id) {
        // TODO: test this function
        $student = $this->entityManager->find(Faculty::class, $id);
        // TODO: the find method can throw an exception, shouldn't that be handled ??

        $this->entityManager->remove($student);
        $this->entityManager->flush();
    }

}