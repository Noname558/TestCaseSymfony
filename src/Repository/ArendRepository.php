<?php

namespace App\Repository;

use App\Entity\Arend;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Arend>
 *
 * @method Arend|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arend|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arend[]    findAll()
 * @method Arend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArendRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arend::class);
    }

    public function save(Arend $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Arend $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
