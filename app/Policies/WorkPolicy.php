<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
{
    public function show(User $user, Work $model)
    {
        return $user->modules->contains($model->module) || $user->can('works.view-all');
    }

    public function update(User $user, Work $model)
    {
        return $user->id === $model->user->id || $user->can('works.update-all');
    }

    public function destroy(User $user, Work $model)
    {
        return $user->id === $model->user->id || $user->can('works.destroy-all');
    }
}
