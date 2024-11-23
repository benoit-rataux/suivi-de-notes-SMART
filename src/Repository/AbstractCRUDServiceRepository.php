<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @template Entity
 * @extends ServiceEntityRepository<Entity>
 * @implements CRUDRepositoryInterface<Entity>
 */
abstract class AbstractCRUDServiceRepository extends ServiceEntityRepository implements CRUDRepositoryInterface {
    /**
     * @param Entity $entity
     * @param bool $flush
     * @return void
     */
    public function save($entity, bool $flush = false): void {
        $this->getEntityManager()->persist($entity);
        
        if($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * @param Entity $entity
     * @param bool $flush
     * @return void
     */
    public function remove($entity, bool $flush = false): void {
        $this->getEntityManager()->remove($entity);
        
        if($flush) {
            $this->getEntityManager()->flush();
        }
    }
}