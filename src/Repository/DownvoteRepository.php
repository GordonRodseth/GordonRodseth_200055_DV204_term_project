<?php

namespace App\Repository;

use App\Entity\Downvote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Downvote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Downvote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Downvote[]    findAll()
 * @method Downvote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DownvoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Downvote::class);
    }

    // /**
    //  * @return Downvote[] Returns an array of Downvote objects
    //  */
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
    public function findOneBySomeField($value): ?Downvote
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
