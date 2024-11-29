<?php

namespace App\Controller\Template\CRUD;

use App\Entity\Student;
use App\Form\StudentType;
use App\Service\CRUD\StudentCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<Student>
 */
#[Route('/crud/student', name: 'app_crud_student_')]
final class StudentCRUDController extends AbstractTwigCRUDController {

    public function __construct(StudentCRUDManager $manager) {
        parent::__construct(Student::class,
                            $manager,
                            StudentType::class,
        );
    }

}
