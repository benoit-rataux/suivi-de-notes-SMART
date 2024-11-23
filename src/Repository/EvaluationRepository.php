<?php

namespace App\Repository;

use App\Entity\Evaluation;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends AbstractCRUDServiceRepository<Evaluation>
 */
class EvaluationRepository extends AbstractCRUDServiceRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Evaluation::class);
    }

//    /**
//     * @return Evaluation[] Returns an array of Evaluation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Evaluation
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
