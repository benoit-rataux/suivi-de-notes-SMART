<?php

namespace App\Service\CRUD;

use App\Repository\StudentRepository;

/**
 * @template-extends AbstractCRUDManager<Student>
 */
class StudentCRUDManager extends AbstractCRUDManager {
    
    public function __construct(
        StudentRepository $repository,
    ) {
        $this->repository = $repository;
    }
}