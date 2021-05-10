<?php

namespace App\Repository;

use App\Entity\Proprietaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Proprietaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proprietaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proprietaires[]    findAll()
 * @method Proprietaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprietairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprietaires::class);
    }

    // /**
    //  * @return Proprietaires[] Returns an array of Proprietaires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Proprietaires
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
