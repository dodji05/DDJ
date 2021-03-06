<?php

namespace App\Repository;

use App\Entity\Commandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
//use Doctrine\ORM\Query\AST\Join;

/**
 * @method Commandes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commandes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commandes[]    findAll()
 * @method Commandes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandes::class);
    }

    // /**
    //  * @return Commandes[] Returns an array of Commandes objects
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
    public function findOneBySomeField($value): ?Commandes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function derniersAchats ($count){
        return $this->createQueryBuilder('o')
          ->addSelect('user')
         //   ->from('App\Entity\User','u')
->Join('o.user', 'user', 'WITH', 'user.id = o.Client')
//->andWhere('o.Client = user.id')
            ->addOrderBy('o.DateCommande', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();

    }

    public function touslesAchats (){
        return $this->createQueryBuilder('o')
            //     ->addSelect('user')
            //     ->andWhere('o.client = user.id')
            ->addOrderBy('o.DateCommande', 'DESC')
//            ->setMaxResults($count)
            ->getQuery()
            ->getResult();

    }
}
