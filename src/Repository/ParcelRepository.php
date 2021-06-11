<?php

namespace App\Repository;

use App\Entity\Parcel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Parcel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parcel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parcel[]    findAll()
 * @method Parcel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parcel::class);
    }

    /**
     * @return Parcel[] Returns an array of Parcel objects
     */
    public function getToPickup()
    {
        return $this->createQueryBuilder('p')
            ->where('p.courier IS NULL')
            ->andWhere('p.warehouse IS NULL')
            ->andWhere('p.delivered = 0')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Parcel[] Returns an array of Parcel objects
     */
    public function getToDelivery()
    {
        return $this->createQueryBuilder('p')
            ->where('p.courier IS NULL')
            ->andWhere('p.warehouse IS NOT NULL')
            ->andWhere('p.delivered = 0')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Parcel[] Returns an array of Parcel objects
     */
    public function getInDelivery()
    {
        return $this->createQueryBuilder('p')
            ->where('p.courier IS NOT NULL')
            ->andWhere('p.warehouse IS NULL')
            ->andWhere('p.delivered = 0')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Parcel
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
