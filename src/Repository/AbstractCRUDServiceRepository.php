<?php

namespace App\Repository;

use App\Repository\Exception\RepositoryException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;

/**
 * @template Entity
 * @extends ServiceEntityRepository<Entity>
 * @implements CRUDRepositoryInterface<Entity>
 */
abstract class AbstractCRUDServiceRepository extends ServiceEntityRepository implements CRUDRepositoryInterface {

    /**
     * @param Entity $entity
     * @param bool   $flush
     *
     * @return void
     * @throws RepositoryException
     */
    public function save($entity, bool $flush = false): void {
        try {
            $this->getEntityManager()->persist($entity);

            if($flush) {
                $this->getEntityManager()->flush();
            }
        }
        catch(Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * @param Entity $entity
     * @param bool   $flush
     *
     * @return void
     * @throws RepositoryException
     */
    public function remove($entity, bool $flush = false): void {
        try {
            $this->getEntityManager()->remove($entity);

            if($flush) {
                $this->getEntityManager()->flush();
            }
        }
        catch(Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

}