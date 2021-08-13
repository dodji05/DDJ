<?php

namespace App\Repository;

use App\Entity\DetailsAbonnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailsAbonnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailsAbonnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailsAbonnement[]    findAll()
 * @method DetailsAbonnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsAbonnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailsAbonnement::class);
    }

    // /**
    //  * @return DetailsAbonnement[] Returns an array of DetailsAbonnement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailsAbonnement
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
