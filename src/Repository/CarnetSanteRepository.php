<?php

namespace App\Repository;

use App\Entity\CarnetSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarnetSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarnetSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarnetSante[]    findAll()
 * @method CarnetSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarnetSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarnetSante::class);
    }

    // /**
    //  * @return CarnetSante[] Returns an array of CarnetSante objects
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
    public function findOneBySomeField($value): ?CarnetSante
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
