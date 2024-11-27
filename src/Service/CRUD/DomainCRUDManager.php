<?php

namespace App\Service\CRUD;

use App\Entity\Domain;
use App\Repository\DomainRepository;

/**
 * @template-extends AbstractCRUDManager<Domain>
 */
class DomainCRUDManager extends AbstractCRUDManager {
    
    public function __construct(
        DomainRepository $repository,
    ) {
        parent::__construct($repository);
    }
}