<?php

namespace App\Controller\Template\CRUD;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Service\CRUD\EvaluationCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<Evaluation>
 */
#[Route('/evaluation', name: 'app_evaluation_')]
final class EvaluationCRUDController extends AbstractTwigCRUDController {
    public function __construct(EvaluationCRUDManager $manager) {
        parent::__construct(Evaluation::class,
                            $manager,
                            EvaluationType::class);
    }
}
