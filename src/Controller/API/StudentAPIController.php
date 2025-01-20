<?php

namespace App\Controller\API;

use App\Controller\Template\CRUD\AbstractTwigCRUDController;
use App\Entity\Student;
use App\Form\StudentType;
use App\Service\CRUD\StudentCRUDManager;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @extends AbstractTwigCRUDController<Student>
 */
#[Route('/custom-api/student', name: 'api_student_')]
final class StudentAPIController extends AbstractAPIController {

    public function __construct(StudentCRUDManager $manager) {
        parent::__construct(Student::class,
                            $manager,
                            StudentType::class,
        );
    }

}
