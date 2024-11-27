<?php

namespace App\Service\CRUD;

use App\Entity\Skill;
use App\Repository\SkillRepository;

/**
 * @template-extends AbstractCRUDManager<Skill>
 */
class SkillCRUDManager extends AbstractCRUDManager {
    
    public function __construct(
        SkillRepository $repository,
    ) {
        parent::__construct($repository);
    }
}