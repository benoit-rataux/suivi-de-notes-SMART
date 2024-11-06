<?php

namespace App\Service\CRUD;

use App\Repository\CategoryRepository;

/**
 * @template-extends AbstractCRUDManager<Category>
 */
class CategoryCRUDManager extends AbstractCRUDManager {
    
    public function __construct(
        CategoryRepository $repository,
    ) {
        $this->repository = $repository;
    }
}