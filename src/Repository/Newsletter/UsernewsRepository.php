<?php

namespace App\Repository\Newsletter;

use App\Entity\Newsletter\Usernews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usernews|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usernews|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usernews[]    findAll()
 * @method Usernews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsernewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usernews::class);
    }

    // /**
    //  * @return Usernews[] Returns an array of Usernews objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usernews
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
