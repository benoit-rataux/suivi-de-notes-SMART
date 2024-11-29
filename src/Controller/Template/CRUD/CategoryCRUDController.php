<?php

namespace App\Controller\Template\CRUD;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Service\CRUD\CategoryCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<Category>
 */
#[Route('/crud/category', name: 'app_crud_category_')]
final class CategoryCRUDController extends AbstractTwigCRUDController {

    public function __construct(CategoryCRUDManager $manager,
    ) {
        parent::__construct(Category::class,
                            $manager,
                            CategoryType::class,
        );
    }

}
