<?php

namespace App\Controller\html\crud;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Service\CRUD\EvaluationCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractCRUDController<Evaluation>
 */
#[Route('/evaluation', name: 'app_evaluation_')]
final class EvaluationCRUDController extends AbstractCRUDController {
    public function __construct(EvaluationCRUDManager $manager) {
        parent::__construct(Evaluation::class,
                            $manager,
                            EvaluationType::class);
    }
}
