<?php

namespace App\Controller\html\crud;

use App\Entity\SchoolClass;
use App\Form\SchoolClassType;
use App\Service\CRUD\SchoolClassCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractCRUDController<SchoolClass>
 */
#[Route('/schoolclass', name: 'app_school_class_')]
final class SchoolClassCRUDController extends AbstractCRUDController {
    public function __construct(SchoolClassCRUDManager $manager) {
        parent::__construct(SchoolClass::class,
                            $manager,
                            SchoolClassType::class);
    }
}
