<?php

namespace App\Controller\Template\CRUD;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Service\CRUD\SkillCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<Skill>
 */
#[Route('/skill', name: 'app_skill_')]
final class SkillCRUDController extends AbstractTwigCRUDController {
    public function __construct(SkillCRUDManager $manager) {
        parent::__construct(Skill::class,
                            $manager,
                            SkillType::class);
    }
}
