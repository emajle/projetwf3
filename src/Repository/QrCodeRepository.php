<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\CarnetSante;
use App\Entity\QrCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QrCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method QrCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method QrCode[]    findAll()
 * @method QrCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QrCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QrCode::class);
    }



    /**
     * Interroge la bdd pour faire si sa existe
     * 
     * SELECT * from qrcode
     * INNER JOIN carnet_sante on 
     * qrcode.animal = animal.id
     * where animal.id = $id
     */

    public function aideqrcode($carnet)
    {

        return $this->createQueryBuilder("qr")
            ->join(CarnetSante::class, "cs", "WITH", "cs.id = qr.carnet")
            ->where(" cs.id =" . $carnet)
            ->getQuery()
            ->getResult();
    }



    // /**
    //  * @return QrCode[] Returns an array of QrCode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QrCode
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
