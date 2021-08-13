<?php

namespace App\Repository;

use App\Entity\CommandeAbonnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeAbonnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeAbonnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeAbonnement[]    findAll()
 * @method CommandeAbonnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeAbonnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeAbonnement::class);
    }

    // /**
    //  * @return CommandeAbonnement[] Returns an array of CommandeAbonnement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommandeAbonnement
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function totalAbonnes ()
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT (DISTINCT (c.user)) ')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
