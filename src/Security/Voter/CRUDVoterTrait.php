<?php

namespace App\Security\Voter;

trait CRUDVoterTrait {
    use RoleCheckingTrait;
    
    public const  CREATE_ = 'CREATE_';
    public const  READ    = "READ";
    public const  UPDATE  = "UPDATE";
    public const  DELETE  = "DELETE";
    
    protected function crudSupports(string $attribute, mixed $subject, string $entity): bool {
        // les actions possibles sur un utilisateur
        return ($subject instanceof $entity
                && in_array($attribute, [
                    self::UPDATE,
                    self::READ,
                    self::DELETE,
                ]))
            || $attribute === self::CREATE;
    }
}