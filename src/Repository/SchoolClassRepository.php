<?php

namespace App\Repository;

use App\Entity\SchoolClass;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends AbstractCRUDServiceRepository<SchoolClass>
 */
class SchoolClassRepository extends AbstractCRUDServiceRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, SchoolClass::class);
    }
    
    //    /**
    //     * @return SchoolClass[] Returns an array of SchoolClass objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
    
    //    public function findOneBySomeField($value): ?SchoolClass
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
