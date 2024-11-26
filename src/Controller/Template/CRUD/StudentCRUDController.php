<?php

namespace App\Controller\Template\CRUD;

use App\Entity\Student;
use App\Form\StudentType;
use App\Service\CRUD\StudentCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<Student>
 */
#[Route('/student', name: 'app_student_')]
final class StudentCRUDController extends AbstractTwigCRUDController {
    public function __construct(StudentCRUDManager $manager) {
        parent::__construct(Student::class,
                            $manager,
                            StudentType::class);
    }
}
