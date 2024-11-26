<?php

namespace App\Controller\Template\CRUD;

use App\Entity\SchoolClass;
use App\Form\SchoolClassType;
use App\Service\CRUD\SchoolClassCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<SchoolClass>
 */
#[Route('/schoolclass', name: 'app_school_class_')]
final class SchoolClassCRUDController extends AbstractTwigCRUDController {
    public function __construct(SchoolClassCRUDManager $manager) {
        parent::__construct(SchoolClass::class,
                            $manager,
                            SchoolClassType::class);
    }
}
