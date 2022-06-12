<?php

namespace App\Repository;

use App\Entity\Contactf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contactf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contactf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contactf[]    findAll()
 * @method Contactf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contactf::class);
    }

    // /**
    //  * @return Contactf[] Returns an array of Contactf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contactf
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
