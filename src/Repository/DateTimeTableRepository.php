<?php

namespace App\Repository;

use App\Entity\DateTimeTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DateTimeTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateTimeTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateTimeTable[]    findAll()
 * @method DateTimeTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateTimeTableRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DateTimeTable::class);
    }

//    /**
//     * @return DateTimeTable[] Returns an array of DateTimeTable objects
//     */
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
    public function findOneBySomeField($value): ?DateTimeTable
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
