<?php

namespace App\Controller\html\crud;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Service\CRUD\CategoryCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractCRUDController<Category>
 */
#[Route('/category', name: 'app_category_')]
final class CategoryCRUDController extends AbstractCRUDController {
    public function __construct(CategoryCRUDManager $manager) {
        parent::__construct(Category::class,
                            $manager,
                            CategoryType::class);
    }
}
