<?php

namespace App\Controller\Template\CRUD;

use App\Entity\Domain;
use App\Form\DomainType;
use App\Service\CRUD\DomainCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<Domain>
 */
#[Route('/domain', name: 'app_domain_')]
final class DomainCRUDController extends AbstractTwigCRUDController {
    public function __construct(DomainCRUDManager $manager,
    ) {
        parent::__construct(Domain::class,
                            $manager,
                            DomainType::class);
    }
}
