<?php

namespace App\Controller\Template\CRUD;

use App\Service\CRUD\CRUDManagerInterface;
use App\Service\Exception\BLLCRUDException;
use ReflectionClass;
use ReflectionObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @template Entity
 */
abstract class AbstractTwigCRUDController extends AbstractController {
    
    // routes 'app_<entity_snake_name>_...';
    private const INDEX  = 'index';
    private const CREATE = 'new';
    private const READ   = 'show';
    private const UPDATE = 'edit';
    private const DELETE = 'delete';

//    private const LABEL_ITEM       = 'item';
//    private const LABEL_COLLECTION = 'collection';
//    private const LABEL_FORM       = 'form';
    
    private array $routes;
    
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
        $entityName      = (new ReflectionClass($entity))->getShortName();
        $entitySnakeName = strtolower(preg_replace('/(?<!^)[A-Z]/',
                                                   '_$0',
                                                   $entityName));
        
        // nom du répertoire contenant les templates twig
        $this->templatesDirectory ??= $entitySnakeName . '/';
        
        // label des variables à envoyer à twig en camel case
        $this->itemLabel            ??= lcfirst($entityName);                     // 'maSuperEntite'
        $this->collectionLabel      ??= $this->itemLabel . 'Collection';          // 'maSuperEntiteList'
        $this->entityFormLabel      ??= $this->itemLabel . 'Form';                // 'maSuperEntiteForm'
        $this->listFiltersFormLabel ??= $this->itemLabel . 'FiltersForm';         // 'maSuperEntiteFiltersForm'

        // récupération de l'attribut route de la classe concrète du controller
        // pour définir le début de toutes les routes
        $reflectionAttributeRoute = (new ReflectionObject($this))->getAttributes(Route::class)[0];
        $routeStart               = $reflectionAttributeRoute->getArguments()['name'];

        // routes
        $this->routes[self::INDEX]  = $routeStart . self::INDEX;
        $this->routes[self::CREATE] = $routeStart . self::CREATE;
        $this->routes[self::READ]   = $routeStart . self::READ;
        $this->routes[self::UPDATE] = $routeStart . self::UPDATE;
        $this->routes[self::DELETE] = $routeStart . self::DELETE;
    }
    
    
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function create(Request $request): Response {
        
        // contrôle des droits
        $item = new $this->entity();
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::CREATE, $item);
        
        $form = $this->createForm($this->entityType, $item);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->create($item);
            
            $this->addFlash('success', 'création : succès');
            return $this->redirectToRoute($this->routes[self::INDEX]);
        }
        
        return $this->makeResponse('new', [
            $this->entityFormLabel => $form,
            $this->itemLabel       => $item,
        ]);
    }
    
    
    #[Route('/', name: 'index', methods: ['GET'])]
    public function readAll(Request $request,
    ): Response {
        // contrôle des droits
        $collection = $this->manager->read();
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::READ_ALL);
        
        return $this->makeResponse(self::INDEX, [
            $this->collectionLabel => $collection,
        ]);
    }
    
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function read(Request $request,
                         int     $id,
    ): Response {
        try {
            // contrôle des droits
            $item = $this->manager->read($id);
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::READ, $item);

            return $this->makeResponse(self::READ, [
                $this->itemLabel => $item,
            ],
            );
        }
        catch(BLLCRUDException $e) {

            $message = '';
            $this->addFlash('error', $message);
            return $this->redirectToRoute($this->routes[self::INDEX]);
        }
    }
    
    
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
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
            $this->addFlash('sucess', $message);
            return $this->redirectToRoute($this->routes[self::INDEX]);
        }
        
        return $this->makeResponse(self::UPDATE, [
            $this->itemLabel       => $item,
            $this->entityFormLabel => $form,
        ]);
    }
    
    
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request,
                           int     $id,
    ): Response {
        // Contrôle des droits
        $item = $this->manager->read($id);
//        $this->denyAccessUnlessGranted($this->entityCRUDVoter::DELETE, $item);
        
        $this->manager->delete($item);
        $this->addFlash('success', 'entitée suprimée');
        return $this->redirectToRoute($this->routes[self::INDEX]);
    }
    
    
    private function makeResponse(string $action,
                                  array  $parameters,
    ): Response {
        // ajout des routes aux paramètres envoyés au template
        $parameters['route'] = $this->routes;
        return $this->render($this->templatesDirectory . $action . '.html.twig',
                             $parameters,
        );
    }
}
