<?php

namespace App\Repository\Newsletter;

use App\Entity\Newsletter\Catenews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Catenews|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catenews|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catenews[]    findAll()
 * @method Catenews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatenewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Catenews::class);
    }

    // /**
    //  * @return Catenews[] Returns an array of Catenews objects
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
    public function findOneBySomeField($value): ?Catenews
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
