<?php

namespace App\Repository;

/**
 * @template Entity of App\Entity
 */
interface CRUDRepositoryInterface {
    
    /**
     * @param int $id
     * @return Entity
     */
    public function find(int $id);
    
    /**
     * @return array<Entity>
     */
    public function findAll(): array;
    
    /**
     * @param Entity $entity
     * @param bool $flush
     * @return void
     */
    public function save($entity, bool $flush = false): void;
    
    /**
     * @param Entity $entity
     * @param bool $flush
     * @return void
     */
    public function remove($entity, bool $flush = false): void;
}