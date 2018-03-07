<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pUC = Permission::create(
            [
                'name' => 'users.create',
                'display_name' => 'Create users'
            ]
        );

        $pUV = Permission::create(
            [
                'name' => 'users.view',
                'display_name' => 'View users'
            ]
        );

        $pUU = Permission::create(
            [
                'name' => 'users.update',
                'display_name' => 'Update users'
            ]
        );

        $pUD = Permission::create(
            [
                'name' => 'users.destroy',
                'display_name' => 'Destroy users'
            ]
        );

        $pRC = Permission::create(
            [
                'name' => 'roles.create',
                'display_name' => 'Create roles'
            ]
        );

        $pRV = Permission::create(
            [
                'name' => 'roles.view',
                'display_name' => 'View roles'
            ]
        );

        $pRU = Permission::create(
            [
                'name' => 'roles.update',
                'display_name' => 'Update roles'
            ]
        );

        $pRD = Permission::create(
            [
                'name' => 'roles.destroy',
                'display_name' => 'Destroy roles'
            ]
        );

        $user = User::create(
            [
                'username' => 'admin',
                'email' => 'admin@teamdog.io',
                'password' => bcrypt('adminp4ss'),
                'first_name' => 'The',
                'last_name'=> 'Admin'
            ]
        );

        $user2 = User::create(
            [
                'username' => 'tester',
                'email' => 'tester@teamdog.io',
                'password' => bcrypt('tester'),
                'first_name' => 'Test',
                'last_name'=> 'Account'
            ]
        );

        $user3 = User::create(
            [
                'username' => 'bitjump',
                'email' => 'me@bitjump.net',
                'password' => bcrypt('tester'),
                'first_name' => 'Daniel',
                'last_name'=> 'Mudd'
            ]
        );

        $manager = User::create(
            [
                'username' => 'manager',
                'email' => 'manager@teamdog.io',
                'password' => bcrypt('m4nager'),
                'first_name' => 'Managing',
                'last_name'=> 'Account'
            ]
        );

        $adminRole = Role::create(
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'The admin group.'
            ]
        );

        $devRole = Role::create(
            [
                'name' => 'developer',
                'display_name' => 'Developer',
                'description' => 'The developer group.'
            ]
        );

        $managerRole = Role::create(
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'The manager group.'
            ]
        );

        $testRole = Role::create(
            [
                'name' => 'tester',
                'display_name' => 'Tester',
                'description' => 'The tester group.'
            ]
        );

        $pU = array($pUU, $pUC, $pUV, $pUD);
        $pR = array($pRU, $pRC, $pRV, $pRD);

        // all perms
        $adminRole->attachPermissions(array_merge($pU, $pR));
        // user view, application view, edit, delete, role view, all attachments, all comments
        $devRole->attachPermissions(array($pUV, $pRV));
        // user view, role view, all applications, attachments, comments
        $managerRole->attachPermissions(array($pUV, $pRV));
        // all views
        $testRole->attachPermissions(array($pRV, $pUV));


        $user->attachRole($adminRole);
        $user2->attachRole($testRole);
        $user3->attachRole($devRole);
        $manager->attachRole($managerRole);
    }
}
