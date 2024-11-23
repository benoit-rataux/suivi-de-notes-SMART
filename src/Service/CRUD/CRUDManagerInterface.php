<?php

namespace App\Service\CRUD;

/**
 * @template Entity
 */
interface CRUDManagerInterface {
    
    /**
     * @param Entity $entity
     * @return void
     */
    public function create($entity): void;
    
    public function read(int $id = null);
    
    public function update($entity): void;
    
    public function delete($entity): void;
    
}