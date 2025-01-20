<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Service\CRUD\EvaluationCRUDManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/smart', name: 'app_smart_')]
class VictoriousSmartController extends AbstractController {

    #[Route('/', name: 'index')]
    public function index(): Response {
        return $this->render('victorious_smart/index.html.twig', [
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request               $request,
                        EvaluationCRUDManager $manager,
    ): Response {

        // contrôle des droits
        $evaluation = new Evaluation();
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::CREATE, $item);

        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->create($evaluation);

            $this->addFlash('success', 'création : succès');
            return $this->redirectToRoute('index');
        }

        return $this->render('victorious_smart/new.html.twig', [
            'form' => $form,
        ]);
    }

}
