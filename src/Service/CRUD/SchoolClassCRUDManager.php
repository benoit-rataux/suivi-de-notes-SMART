<?php

namespace App\Service\CRUD;

use App\Entity\Student;
use App\Repository\SchoolClassRepository;

/**
 * @template-extends AbstractCRUDManager<Student>
 */
class SchoolClassCRUDManager extends AbstractCRUDManager {
    
    public function __construct(
        SchoolClassRepository $repository,
    ) {
        parent::__construct($repository);
    }
}