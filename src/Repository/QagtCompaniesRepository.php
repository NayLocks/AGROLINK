<?php

namespace App\Repository;

use App\Entity\QagtCompanies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QagtCompanies>
 */
class QagtCompaniesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QagtCompanies::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('c')    
            ->where('c.companyName != :default')
            ->setParameter('default', 'DEFAUT')
            ->orderBy('c.isActived', 'DESC')
            ->addOrderBy('c.companyName', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return QagtCompanies[] Returns an array of QagtCompanies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QagtCompanies
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
