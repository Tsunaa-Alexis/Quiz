<?php

namespace App\Repository;

use App\Entity\pUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method pUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method pUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method pUser[]    findAll()
 * @method pUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class pUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, pUser::class);
    }

    // /**
    //  * @return pUser[] Returns an array of pUser objects
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
    public function findOneBySomeField($value): ?pUser
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
