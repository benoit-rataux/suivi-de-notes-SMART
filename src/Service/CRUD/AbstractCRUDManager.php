<?php

namespace App\Service\CRUD;

use App\Repository\CRUDRepositoryInterface;

/**
 * @template Entity
 */
abstract class AbstractCRUDManager implements CRUDManagerInterface {
    private CRUDRepositoryInterface $repository;
    
    public function __construct(CRUDRepositoryInterface $repository) {
        $this->repository = $repository;
    }
    
    public function create($entity): void {
//        $entity->setDateCreation(new DateTimeImmutable());
        
        $this->repository->save($entity, true);
    }
    
    /**
     * @param int|null $id
     * @return Entity|array<Entity>
     */
    public function read(int $id = null) {
        if($id) return $this->repository->find($id);
        else    return $this->repository->findAll();
    }
    
    public function update($entity): void {
//        $entity->setDateLastUpdate(new DateTimeImmutable()); // TODO - ajouter dates de création et dernière mise à jour aux entity
        
        $this->repository->save($entity, true);
    }
    
    public function delete($entity): void {
        $this->repository->remove($entity, true);
    }
}
