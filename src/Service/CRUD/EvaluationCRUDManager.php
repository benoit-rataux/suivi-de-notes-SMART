<?php

namespace App\Service\CRUD;

use App\Repository\EvaluationRepository;

/**
 * @template-extends AbstractCRUDManager<Evaluation>
 */
class EvaluationCRUDManager extends AbstractCRUDManager {
    
    public function __construct(
        EvaluationRepository $repository,
    ) {
        $this->repository = $repository;
    }
}