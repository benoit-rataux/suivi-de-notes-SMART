<?php

namespace App\Service\CRUD;

use App\Repository\CRUDRepositoryInterface;
use App\Repository\Exception\RepositoryException;
use App\Service\Exception\BLLCRUDException;
use Exception;

/**
 * @template Entity
 */
abstract class AbstractCRUDManager implements CRUDManagerInterface {

    private CRUDRepositoryInterface $repository;

    public function __construct(CRUDRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * @param $entity
     *
     * @return void
     * @throws BLLCRUDException
     */
    public function create($entity): void {
        try {
//        $entity->setDateCreation(new DateTimeImmutable());

            $this->repository->save($entity, true);
        }
        catch(RepositoryException $e) {
            throw new BLLCRUDException($e->getMessage());
        }
    }

    /**
     * @param int|null $id
     *
     * @return Entity|array<Entity>
     * @throws BLLCRUDException
     */
    public function read(?int $id = null): mixed {
        try {
            if($id) return $this->repository->find($id);
            else    return $this->repository->findAll();
        }
        catch(Exception $e) {
            throw new BLLCRUDException($e->getMessage());
        }
    }

    /**
     * @param $entity
     *
     * @return void
     * @throws BLLCRUDException
     */
    public function update($entity): void {
        try {
//        $entity->setDateLastUpdate(new DateTimeImmutable()); // TODO - ajouter dates de création et dernière mise à jour aux entity

            $this->repository->save($entity, true);
        }
        catch(RepositoryException $e) {
            throw new BLLCRUDException($e->getMessage());
        }
    }

    /**
     * @param $entity
     *
     * @return void
     * @throws BLLCRUDException
     */
    public function delete($entity): void {
        try {
            $this->repository->remove($entity, true);
        }
        catch(RepositoryException $e) {
            throw new BLLCRUDException($e->getMessage());
        }
    }

}
