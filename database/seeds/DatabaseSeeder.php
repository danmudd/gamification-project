<?php

use App\Models\Module;
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

        $pMC = Permission::create(
            [
                'name' => 'modules.create',
                'display_name' => 'Create modules'
            ]
        );

        $pMV = Permission::create(
            [
                'name' => 'modules.view',
                'display_name' => 'View modules'
            ]
        );

        $pMU = Permission::create(
            [
                'name' => 'modules.update',
                'display_name' => 'Update modules'
            ]
        );

        $pMD = Permission::create(
            [
                'name' => 'modules.destroy',
                'display_name' => 'Destroy modules'
            ]
        );

        $pMUA = Permission::create(
            [
                'name' => 'modules.users.add',
                'display_name' => 'Add a user to a module'
            ]
        );

        $pMUR = Permission::create(
            [
                'name' => 'modules.users.remove',
                'display_name' => 'Remove a user from a module'
            ]
        );

        $pWC = Permission::create(
            [
                'name' => 'works.create',
                'display_name' => 'Create works'
            ]
        );

        $pWV = Permission::create(
            [
                'name' => 'works.view',
                'display_name' => 'View works'
            ]
        );

        $pWU = Permission::create(
            [
                'name' => 'works.update',
                'display_name' => 'Update works'
            ]
        );

        $pWD = Permission::create(
            [
                'name' => 'works.destroy',
                'display_name' => 'Destroy works'
            ]
        );

        $pWAC = Permission::create(
            [
                'name' => 'works.attachments.create',
                'display_name' => 'Create attachments'
            ]
        );

        $pWAV = Permission::create(
            [
                'name' => 'works.attachments.view',
                'display_name' => 'View attachments'
            ]
        );

        $pWAD = Permission::create(
            [
                'name' => 'works.attachments.destroy',
                'display_name' => 'Destroy attachments'
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
        $pM = array($pMU, $pMC, $pMV, $pMD);
        $pW = array($pWU, $pWC, $pWV, $pWD);
        $pWA = array($pWAC, $pWAV, $pWAD);
        $pMU = array($pMUA, $pMUR);

        // all perms
        $adminRole->attachPermissions(array_merge($pU, $pR, $pM, $pW, $pWA, $pMU));
        // user view, application view, edit, delete, role view, all attachments, all comments
        $devRole->attachPermissions(array($pUV, $pRV, $pMV));
        // user view, role view, all applications, attachments, comments
        $managerRole->attachPermissions(array($pUV, $pRV, $pMV));
        // all views
        $testRole->attachPermissions(array($pRV, $pUV, $pMV));


        $user->attachRole($adminRole);
        $user2->attachRole($testRole);
        $user3->attachRole($devRole);
        $manager->attachRole($managerRole);

        $mod1 = Module::create(
            [
                'code' => 'CET105',
                'name' => 'Web Development',
                'description' => 'Intro to web dev!'
            ]
        );

        $mod2 = Module::create(
            [
                'code' => 'CET205',
                'name' => 'Advanced Web Development',
                'description' => 'More complex materials!'
            ]
        );

    }
}
