<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\College;
use Doctrine\ORM\EntityManager;

class CollegeService
{
    public function __construct(
        private readonly EntityManager $entityManager,
    ){
    }

    public function create(array $data): College {
        $college = new College();

        $college->setName($data['name']);
        $college->setCode($data['code']);
        $college->initializeCollegeYearArray();
        $year = (new \DateTime('now'))->format('Y');
        $college->createSerialNumber((int) $year);

        $this->entityManager->persist($college);
        $this->entityManager->flush();

        return $college;
    }

    public function fetchById(int $id): College|null {
        return $this->entityManager->getRepository(College::class)->findOneBy(['id' => $id]);
    }

    public function fetchByName(string $name): array {
        $qb = $this->entityManager->getRepository(College::class)->createQueryBuilder('f');
        return $qb
            ->select()
            ->where($qb->expr()->like('f.name', $qb->expr()->literal('%'.$name.'%')))
            ->getQuery()
            ->getArrayResult();
    }

    public function fetchAll() {
        return $this->entityManager->getRepository(College::class)->findAll();
    }

    public function fetchCollegeNames(): array
    {
        return $this->entityManager
            ->getRepository(College::class)
            ->createQueryBuilder('f')
            ->select('f.id', 'f.name')
            ->getQuery()
            ->getArrayResult();
    }

    public function updateName(College $college, string $newName) {
        $college->setName($newName);

        $this->entityManager->persist($college);
        $this->entityManager->flush();

        return $college;
    }

    public function updateCode(College $college, string $newCode) {
        $college->setCode($newCode);

        $this->entityManager->persist($college);
        $this->entityManager->flush();

        return $college;
    }

    public function incrementSerialNumber(College $college, int $year): College {
        $college = $college->incrementSerialNumber($year);

        $this->entityManager->persist($college);
        $this->entityManager->flush();

        return $college;
    }

    public function delete(int $id) {
        $student = $this->entityManager->find(College::class, $id);
        // TODO: the find method can throw an exception, shouldn't that be handled ??

        $this->entityManager->remove($student);
        $this->entityManager->flush();
    }

}