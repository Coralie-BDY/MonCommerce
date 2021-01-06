<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }



    /**
     * @return Query
     */
    public function findAllVisibleQuery(ArticleSearch $search) : Query
    {
        $query = $this->findVisibleQuery();

        if ($search->getMaxPrice())
        {
            $query = $query
                ->andWhere('a.prix <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }
        if ($search->getMinTaille())
        {
            $query = $query
                ->andWhere('a.taille >= :mintaille')
                ->setParameter('mintaille', $search->getMinTaille());
        }

        if ($search->getOptions()->count() > 0)
        {
            $k = 0;

            foreach ($search->getOptions() as $option)
            {
                $k++;

                $query = $query
                ->andWhere(":option$k MEMBER OF a.options")
                ->setParameter("option$k", $option);
            }
        }

        return $query ->getQuery();

    }

    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->where('a.vendu = false');

    }
    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
