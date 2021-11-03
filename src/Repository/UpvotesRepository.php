<?php

namespace App\Repository;

use App\Entity\Upvotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Upvotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Upvotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Upvotes[]    findAll()
 * @method Upvotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpvotesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Upvotes::class);
    }

    // /**
    //  * @return Upvotes[] Returns an array of Upvotes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Upvotes
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
