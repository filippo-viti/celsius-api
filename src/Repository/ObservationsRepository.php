<?php

namespace App\Repository;

use App\Entity\Observations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Observations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Observations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Observations[]    findAll()
 * @method Observations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObservationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Observations::class);
    }

    public function findAllBetween(string $from, string $to)
    {
        $query = $this->createQueryBuilder('o')
            ->andWhere("o.time BETWEEN :from AND :to")
            ->setParameter("from", $from)
            ->setParameter("to", $to);

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Observations[] Returns an array of Observations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Observations
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
