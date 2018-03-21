<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
{
    public function update(User $user, Work $model)
    {
        return $user->id === $model->user()->id || $user->can('works.update');
    }
}
