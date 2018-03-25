<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{

    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->can('users.update-all');
    }
}
