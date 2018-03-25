<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;

class ModulePolicy
{

    public function show(User $user, Module $model)
    {
        return $user->modules->contains($model) || $user->can('modules.view-all');
    }
}
