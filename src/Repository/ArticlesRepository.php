<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function findByPret($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.pret = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getCustomInformations()
    {
        $rawSql = "SELECT a.id, a.nom FROM articles a WHERE a.id NOT IN (SELECT a.id FROM articles a INNER JOIN prets_articles pa ON a.id = pa.articles_id INNER JOIN prets p ON p.id = pa.prets_id WHERE p.is_returned = false)";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAllAssociative();
    }

    public function getArticles()
    {
        $rawSql = "SELECT a.id as id, a.nom as nom, a.marque as marque, c.nom categorie, a.description description, a.commentaire commentaire, a.date_arrivee dateArrivee, a.etat etat, p.is_returned pret FROM articles a INNER JOIN categories c ON a.categorie_id = c.id LEFT JOIN prets_articles pa ON a.id = pa.articles_id INNER JOIN prets p ON p.id = pa.prets_id";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAllAssociative();
    }

    public function getArticlesParPret($id)
    {
        $rawSql = "SELECT a.id as id, a.reference as reference, a.nom as nom, a.marque as marque, c.nom as categorie, a.description as description, a.etat as etat FROM articles a INNER JOIN categories as c ON c.id = a.categorie_id INNER JOIN prets_articles pa ON a.id = pa.articles_id WHERE pa.prets_id = ?";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([$id]);

        return $stmt->fetchAllAssociative();
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }



    SELECT a.id FROM articles a WHERE a.id NOT IN(SELECT pa.articles_id FROM prets_articles pa)

    */


}
