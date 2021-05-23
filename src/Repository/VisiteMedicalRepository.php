<?php

namespace App\Repository;

use App\Entity\VisiteMedical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VisiteMedical|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisiteMedical|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisiteMedical[]    findAll()
 * @method VisiteMedical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteMedicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisiteMedical::class);
    }

    // /**
    //  * @return VisiteMedical[] Returns an array of VisiteMedical objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VisiteMedical
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
