<?php

namespace App\Repository;

use App\Entity\Dessins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dessins|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dessins|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dessins[]    findAll()
 * @method Dessins[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DessinsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dessins::class);
    }

    // /**
    //  * @return Dessins[] Returns an array of Dessins objects
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
    public function findOneBySomeField($value): ?Dessins
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
