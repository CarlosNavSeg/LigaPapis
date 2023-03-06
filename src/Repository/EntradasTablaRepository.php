<?php

namespace App\Repository;

use App\Entity\EntradasTabla;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EntradasTabla>
 *
 * @method EntradasTabla|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntradasTabla|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntradasTabla[]    findAll()
 * @method EntradasTabla[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntradasTablaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntradasTabla::class);
    }

    public function save(EntradasTabla $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EntradasTabla $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findEntradasByPapi($papi) {
        return $this->createQueryBuilder('e')
        ->andWhere('e.Papi = :papi')
        ->setParameter('papi', $papi)
        ->orderBy('e.Fecha', 'desc')
        ->getQuery()
        ->getResult()
        ;
    }

//    /**
//     * @return EntradasTabla[] Returns an array of EntradasTabla objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EntradasTabla
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
