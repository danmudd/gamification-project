<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;

class ModulePolicy
{

    /**
     * Checks whether a user is part of a module or has an overriding permission
     *
     * @param User $user User accessing the resource
     * @param Module $model Resource being accessed
     * @return bool
     */
    public function show(User $user, Module $model)
    {
        return $user->modules->contains($model) || $user->can('modules.view-all');
    }
}
