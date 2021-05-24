<?php

namespace App\Repository;

use App\Entity\CarnetSante;
use App\Entity\VaccinsEtOperation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method VaccinsEtOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method VaccinsEtOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method VaccinsEtOperation[]    findAll()
 * @method VaccinsEtOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VaccinsEtOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VaccinsEtOperation::class);
    }

    public function jointCarnetOperation($idop)
    {

        /**
         * SELECT * FROM Vaccin/operation AS vm
         * INNER JOIN carnet_sante as cs ON 
         * vm.carnet_id = cs.id
         * WHERE vm.carnet_id = $idvm
         */
        return $this->createQueryBuilder("vo")
            ->join(CarnetSante::class, "cs", "WITH", "vo.carnet=cs.id")
            ->where("vo.carnet =" . $idop)
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return VaccinsEtOperation[] Returns an array of VaccinsEtOperation objects
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
    public function findOneBySomeField($value): ?VaccinsEtOperation
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
