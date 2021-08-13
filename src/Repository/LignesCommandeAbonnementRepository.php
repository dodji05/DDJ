<?php

namespace App\Repository;

use App\Entity\LignesCommandeAbonnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LignesCommandeAbonnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method LignesCommandeAbonnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method LignesCommandeAbonnement[]    findAll()
 * @method LignesCommandeAbonnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignesCommandeAbonnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LignesCommandeAbonnement::class);
    }

    // /**
    //  * @return LignesCommandeAbonnement[] Returns an array of LignesCommandeAbonnement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LignesCommandeAbonnement
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
