<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
{

    /**
     * Checks whether a user is part of a module or has an overriding permission to view it
     *
     * @param User $user User accessing the resource
     * @param Work $model Resource being accessed
     * @return bool
     */
    public function show(User $user, Work $model)
    {
        return $user->modules->contains($model->module) || $user->can('works.view-all');
    }

    /**
     * Checks whether a user owns a module or has an overriding permission to edit it
     *
     * @param User $user User accessing the resource
     * @param Work $model Resource being accessed
     * @return bool
     */
    public function update(User $user, Work $model)
    {
        return $user->id === $model->user->id || $user->can('works.update-all');
    }

    /**
     * Checks whether a user owns a module or has an overriding permission to destroy it
     *
     * @param User $user User accessing the resource
     * @param Work $model Resource being accessed
     * @return bool
     */
    public function destroy(User $user, Work $model)
    {
        return $user->id === $model->user->id || $user->can('works.destroy-all');
    }
}
