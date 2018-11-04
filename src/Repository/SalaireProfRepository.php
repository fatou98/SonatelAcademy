<?php

namespace App\Repository;

use App\Entity\SalaireProf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SalaireProf|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalaireProf|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalaireProf[]    findAll()
 * @method SalaireProf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalaireProfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SalaireProf::class);
    }

//    /**
//     * @return SalaireProf[] Returns an array of SalaireProf objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SalaireProf
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
