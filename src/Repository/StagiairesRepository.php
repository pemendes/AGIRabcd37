<?php

namespace App\Repository;

use App\Entity\Stagiaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stagiaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stagiaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stagiaires[]    findAll()
 * @method Stagiaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagiairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stagiaires::class);
    }

    // /**
    //  * @return Stagiaires[] Returns an array of Stagiaires objects
    //  */
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
    public function findOneBySomeField($value): ?Stagiaires
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
