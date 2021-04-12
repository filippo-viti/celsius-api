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

    public function findByDay(string $time)
    {
        $query = $this->createQueryBuilder('o')
            ->where('DATE(o.time) = :time')
            ->setParameter('time', $time);

        return $query->getQuery()->getResult();
    }

    public function findByMonth(int $year, int $month)
    {
        $query = $this->createQueryBuilder('o')
            ->where('YEAR(o.time) = :year')
            ->andWhere('MONTH(o.time) = :month')
            ->setParameter('year', $year)
            ->setParameter('month', $month);

        return $query->getQuery()->getResult();
    }

    public function findByYear(int $year)
    {
        $query = $this->createQueryBuilder('o')
            ->where('YEAR(o.time) = :year')
            ->setParameter('year', $year);

        return $query->getQuery()->getResult();
    }

    public function findBetweenTwoMonths(int $year1, int $month1, int $year2, int $month2)
    {
        $query = $this->createQueryBuilder('o')
            ->where('YEAR(o.time) BETWEEN :year1 and :year2')
            ->andWhere('MONTH(o.time) BETWEEN :month1 and :month2')
            ->setParameter('year1', $year1)
            ->setParameter('year2', $year2)
            ->setParameter('month1', $month1)
            ->setParameter('month2', $month2);

        return $query->getQuery()->getResult();
    }

    public function findBetweenTwoDays(string $day1, string $day2)
    {
        $query = $this->createQueryBuilder('o')
            ->where('DATE(o.time) BETWEEN :day1 and :day2')
            ->setParameter('day1', $day1)
            ->setParameter('day2', $day2);

        return $query->getQuery()->getResult();
    }

    public function findBetweenTwoYears(int $year1, int $year2)
    {
        $query = $this->createQueryBuilder('o')
            ->where('YEAR(o.time) BETWEEN :year1 and :year2')
            ->setParameter('year1', $year1)
            ->setParameter('year2', $year2);

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
