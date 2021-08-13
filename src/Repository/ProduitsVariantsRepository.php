<?php

namespace App\Repository;

use App\Entity\ProduitsVariants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitsVariants|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitsVariants|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitsVariants[]    findAll()
 * @method ProduitsVariants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsVariantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitsVariants::class);
    }

    // /**
    //  * @return ProduitsVariants[] Returns an array of ProduitsVariants objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitsVariants
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
