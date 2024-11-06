<?php

namespace App\Controller\html\crud;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/student', name: 'app_student_')]
final class StudentCRUDController extends AbstractController {
    #[Route(name: 'index', methods: ['GET'])]
    public function index(StudentRepository $studentRepository): Response {
        return $this->render('student/index.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }
    
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $student = new Student();
        $form    = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($student);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form'    => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Student $student): Response {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Student $student, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            
            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form'    => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Student $student, EntityManagerInterface $entityManager): Response {
        if($this->isCsrfTokenValid('delete' . $student->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($student);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
    }
}
