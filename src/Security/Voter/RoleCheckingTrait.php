<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;

trait RoleCheckingTrait {
    
    public function __construct(
        private Security $security,
    ) {}
    
    protected function isGranted(User $user, string | array $roles): bool {
//        if (is_string($roles))
//            return in_array($roles, $user->getRoles());
//
//        return !empty(array_intersect($user->getRoles(), $roles));
        
        if(is_string($roles))
            return $this->security->isGranted($roles);
        
        foreach($roles as $role)
            if($this->security->isGranted($role)) return true;
        return false;
    }
}