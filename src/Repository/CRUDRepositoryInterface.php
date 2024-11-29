<?php

namespace App\Repository;

use App\Repository\Exception\RepositoryException;

/**
 * @template Entity of App\Entity
 */
interface CRUDRepositoryInterface {

    /**
     * @param int $id
     *
     * @return Entity
     */
    public function find(int $id);

    /**
     * @return array<Entity>
     */
    public function findAll(): array;

    /**
     * @param Entity $entity
     * @param bool   $flush
     *
     * @return void
     * @throws RepositoryException
     */
    public function save($entity, bool $flush = false): void;

    /**
     * @param Entity $entity
     * @param bool   $flush
     *
     * @return void
     * @throws RepositoryException
     */
    public function remove($entity, bool $flush = false): void;

}