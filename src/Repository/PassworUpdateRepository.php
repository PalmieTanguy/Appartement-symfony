<?php

namespace App\Repository;

use App\Entity\PassworUpdate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PassworUpdate|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassworUpdate|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassworUpdate[]    findAll()
 * @method PassworUpdate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassworUpdateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PassworUpdate::class);
    }

    // /**
    //  * @return PassworUpdate[] Returns an array of PassworUpdate objects
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
    public function findOneBySomeField($value): ?PassworUpdate
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
