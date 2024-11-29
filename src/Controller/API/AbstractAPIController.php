<?php

namespace App\Controller\API;

use App\Service\CRUD\CRUDManagerInterface;
use Exception;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\UnicodeString;

/**
 * @template Entity
 */
abstract class AbstractAPIController extends AbstractController {

    // routes 'app_<entity_snake_name>_...';
    private const READ_ALL = 'index';
    private const CREATE   = 'new';
    private const READ     = 'show';
    private const UPDATE   = 'edit';
    private const DELETE   = 'delete';

//    private const LABEL_ITEM       = 'item';
//    private const LABEL_COLLECTION = 'collection';
//    private const LABEL_FORM       = 'form';

    private string $entityName;
    private string $entityCamelName;
    private string $entitySnakeName;

    protected function __construct(
        private readonly string               $entity,
        private readonly CRUDManagerInterface $manager,
        private readonly string               $entityType,
//        private string  $entityCRUDVoter,
//        private ?string $entityType,
        private ?string                       $templatesDirectory = null,
        private ?string                       $itemLabel = null,
        private ?string                       $collectionLabel = null,
        private ?string                       $entityFormLabel = null,
        private ?string                       $listFiltersFormLabel = null,
    ) {
        $this->entityName      = (new ReflectionClass($entity))->getShortName();
        $this->entityCamelName = lcfirst($this->entityName);
        $this->entitySnakeName = (new UnicodeString($this->entityName))->snake();

        // nom du répertoire contenant les templates twig
        $this->templatesDirectory ??= $this->entitySnakeName . '/';

        // label des variables à envoyer à twig en camel case
        $this->itemLabel            ??= $this->entityCamelName;                         // 'maSuperEntite'
        $this->collectionLabel      ??= $this->itemLabel . 'Collection';                // 'maSuperEntiteList'
        $this->entityFormLabel      ??= $this->itemLabel . 'Form';                      // 'maSuperEntiteForm'
        $this->listFiltersFormLabel ??= $this->itemLabel . 'FiltersForm';               // 'maSuperEntiteFiltersForm'
    }


    #[Route('/new', name: self::CREATE, methods: ['POST'])]
    public function create(Request             $request,
                           SerializerInterface $serializer,
    ): Response {

        // contrôle des droits
//        $item = new $this->entity();
        try {
            $item = $serializer->deserialize(
                $request->getContent(),
                $this->entity,
                'json',
            );
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::CREATE, $item);
            return $this->makeResponse($item, Response::HTTP_CREATED);
        }
        catch(Exception $e) {
            return $this->makeResponse(null, Response::HTTP_BAD_REQUEST);

        }
    }


    #[Route('/', name: self::READ_ALL, methods: ['GET'])]
    public function readAll(Request $request,
    ): Response {
        // contrôle des droits
        $collection = $this->manager->read();
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::READ_ALL);

        return $this->makeResponse($collection, Response::HTTP_OK);
    }

    #[Route('/{id}', name: self::READ, methods: ['GET'])]
    public function read(Request $request,
                         int     $id,
    ): Response {
        // contrôle des droits
        $item = $this->manager->read($id);
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::READ, $item);

        return $this->makeResponse($item, Response::HTTP_FOUND);
    }


    #[Route('/{id}', name: self::UPDATE, methods: ['PUT'])]
    public function update(Request $request,
                           int     $id,
    ): Response {
        // Contrôle des droits
        $item = $this->manager->read($id);
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::UPDATE, $item);

        $form = $this->createForm($this->entityType, $item);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->update($item);
            $message = 'entitée modifiée avec succès';

            return $this->makeResponse($item,
                                       Response::HTTP_OK,
            );
        }

        return $this->makeResponse($item,
                                   Response::HTTP_NOT_MODIFIED,
        );
    }


    #[Route('/{id}', name: self::DELETE, methods: ['POST'])]
    public function delete(Request $request,
                           int     $id,
    ): Response {
        // Contrôle des droits
        $item = $this->manager->read($id);
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::DELETE, $item);

        $this->manager->delete($item);
//        $this->addFlash('success', 'entitée suprimée');
//        return $this->redirectToRoute($this->routes[self::INDEX]);
        return $this->makeResponse(data  : $item,
                                   status: Response::HTTP_OK,
        );
    }


    private function makeResponse(mixed  $data,
                                  string $status,
    ): Response {
        return $this->json(data   : $data,
                           context: ['groups' => $this->entitySnakeName],
                           status : $status,
        );
    }

}
