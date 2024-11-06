<?php

namespace App\Service\CRUD;

interface CRUDManagerInterface {
    
    public function create($entity): void;
    
    public function read(int $id = null);
    
    public function update($entity): void;
    
    public function delete($entity): void;
    
}