<?php

namespace App\Repository;

use App\Entity\Papi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Papi>
 *
 * @method Papi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Papi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Papi[]    findAll()
 * @method Papi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PapiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Papi::class);
    }

    public function save(Papi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Papi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAll()
    {
    return $this->createQueryBuilder('p')
        ->orderBy('p.PuntosTotales', 'DESC')
        ->getQuery()
        ->getResult()
    ;
    }

//    /**
//     * @return Papi[] Returns an array of Papi objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Papi
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
