<?php

namespace App\Repository;

/**
 * @template Entity
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
    
}