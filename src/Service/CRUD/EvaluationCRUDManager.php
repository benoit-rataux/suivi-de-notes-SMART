<?php

namespace App\Service\CRUD;

use App\Entity\Evaluation;
use App\Repository\EvaluationRepository;

/**
 * @template-extends AbstractCRUDManager<Evaluation>
 */
class EvaluationCRUDManager extends AbstractCRUDManager {
    
    public function __construct(
        EvaluationRepository $repository,
    ) {
        parent::__construct($repository);
    }
}