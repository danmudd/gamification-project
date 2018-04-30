<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoleTest extends TestCase
{
    public function test_can_user_have_role()
    {
        /* @var $user User */
        $user = factory(User::class)->create();
        /* @var $role Role */
        $role = factory(Role::class)->create();
        $user->attachRole($role);

        $this->assertTrue($user->hasRole($role->name));
    }

    public function test_can_user_have_multiple_roles()
    {
        /* @var $user User */
        $user = factory(User::class)->create();
        /* @var $role Role */
        $role = factory(Role::class)->create();
        $role2 = factory(Role::class)->create();
        $user->attachRole($role);
        $user->attachRole($role2);

        $this->assertTrue($user->hasRole([$role->name, $role2->name], true));
    }

    public function test_can_role_have_permission()
    {
        /* @var $user User */
        $user = factory(User::class)->create();
        /* @var $role Role */
        $role = factory(Role::class)->create();
        $user->attachRole($role);
        $permission = factory(Permission::class)->create();
        $role->attachPermission($permission);

        $this->assertTrue($user->can($permission->name));
    }
}
