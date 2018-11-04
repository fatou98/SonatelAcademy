<?php

namespace App\Repository;

use App\Entity\HeureProf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HeureProf|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeureProf|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeureProf[]    findAll()
 * @method HeureProf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeureProfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HeureProf::class);
    }

//    /**
//     * @return HeureProf[] Returns an array of HeureProf objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeureProf
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
