<?php

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Work;
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

        $pMVA = Permission::create(
            [
                'name' => 'modules.view-all',
                'display_name' => 'View all modules'
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

        $pWVA = Permission::create(
            [
                'name' => 'works.view-all',
                'display_name' => 'View all works'
            ]
        );

        $pWU = Permission::create(
            [
                'name' => 'works.update',
                'display_name' => 'Update works'
            ]
        );

        $pWUA = Permission::create(
            [
                'name' => 'works.update-all',
                'display_name' => 'Update all works'
            ]
        );

        $pWD = Permission::create(
            [
                'name' => 'works.destroy',
                'display_name' => 'Destroy works'
            ]
        );

        $pWDA = Permission::create(
            [
                'name' => 'works.destroy-all',
                'display_name' => 'Destroy all works'
            ]
        );

        $pWAC = Permission::create(
            [
                'name' => 'works.attachments.create',
                'display_name' => 'Create attachments'
            ]
        );

        $pWACA = Permission::create(
            [
                'name' => 'works.attachments.create-all',
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

        $pWADA = Permission::create(
            [
                'name' => 'works.attachments.destroy-all',
                'display_name' => 'Destroy all attachments'
            ]
        );

        $pWFC = Permission::create(
            [
                'name' => 'works.feedbacks.create',
                'display_name' => 'Create feedbacks'
            ]
        );

        $pWFCA = Permission::create(
            [
                'name' => 'works.feedbacks.create-all',
                'display_name' => 'Create all feedbacks'
            ]
        );

        $pWFD = Permission::create(
            [
                'name' => 'works.feedbacks.destroy',
                'display_name' => 'Destroy feedbacks'
            ]
        );

        $pWFDA = Permission::create(
            [
                'name' => 'works.feedbacks.destroy-all',
                'display_name' => 'Destroy all feedbacks'
            ]
        );

        $pWFV = Permission::create(
            [
                'name' => 'works.feedbacks.view',
                'display_name' => 'View feedbacks'
            ]
        );

        $pWFVA = Permission::create(
            [
                'name' => 'works.feedbacks.view-all',
                'display_name' => 'View all feedbacks'
            ]
        );

        $admin = User::create(
            [
                'username' => 'admin',
                'email' => 'admin@teamdog.io',
                'password' => bcrypt('adminp4ss'),
                'first_name' => 'Admin',
                'last_name'=> 'Account'
            ]
        );

        $tester = User::create(
            [
                'username' => 'tester',
                'email' => 'tester@teamdog.io',
                'password' => bcrypt('tester'),
                'first_name' => 'Test',
                'last_name'=> 'Account'
            ]
        );

        $student = User::create(
            [
                'username' => 'bg85td',
                'email' => 'bg85td@student.sunderland.ac.uk',
                'password' => bcrypt('student'),
                'first_name' => 'Daniel',
                'last_name'=> 'Mudd'
            ]
        );

        $student2 = User::create(
            [
                'username' => 'bg88wc',
                'email' => 'bg88wc@student.sunderland.ac.uk',
                'password' => bcrypt('student'),
                'first_name' => 'Charlotte',
                'last_name'=> 'Anderson'
            ]
        );

        $faculty = User::create(
            [
                'username' => 'andrew.smith',
                'email' => 'andrew.smith@sunderland.ac.uk',
                'password' => bcrypt('module'),
                'first_name' => 'Andrew',
                'last_name'=> 'Smith'
            ]
        );

        $moduleLeader = User::create(
            [
                'username' => 'siobhan.devlin',
                'email' => 'siobhan.devlin@sunderland.ac.uk',
                'password' => bcrypt('faculty'),
                'first_name' => 'Siobhan',
                'last_name'=> 'Devlin'
            ]
        );

        $adminRole = Role::create(
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'The admin group.'
            ]
        );

        $studentRole = Role::create(
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'The student group.'
            ]
        );

        $facultyRole = Role::create(
            [
                'name' => 'faculty',
                'display_name' => 'Faculty',
                'description' => 'The faculty group.'
            ]
        );

        $moduleLeaderRole = Role::create(
            [
                'name' => 'module-leader',
                'display_name' => 'Module Leader',
                'description' => 'The module leader group.'
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
        $pM = array($pMU, $pMC, $pMV, $pMVA, $pMD);
        $pW = array($pWU, $pWUA, $pWC, $pWV, $pWVA, $pWD, $pWDA);
        $pWA = array($pWAC, $pWACA, $pWAV, $pWAD, $pWADA);
        $pWF = array($pWFC, $pWFCA, $pWFD, $pWFDA, $pWFV, $pWFVA);
        $pMU = array($pMUA, $pMUR);

        // all perms
        $adminRole->attachPermissions(array_merge($pU, $pR, $pM, $pW, $pWA, $pWF, $pMU));
        $facultyRole->attachPermissions(array_merge(array($pUV, $pMV, $pMVA, $pRV, $pWV, $pWVA, $pWAV), $pWF, $pMU));
        $moduleLeaderRole->attachPermissions(array_merge(array($pUV, $pRV), $pM, $pW, $pWA, $pWF, $pMU));
        $studentRole->attachPermissions(array($pUV, $pRV, $pMV, $pWV, $pWC, $pWD, $pWU, $pWAC, $pWAV, $pWAD, $pWFC, $pWFD, $pWFV));
        $testRole->attachPermissions(array($pRV, $pUV, $pMV, $pWV));


        $admin->attachRole($adminRole);
        $tester->attachRole($testRole);
        $student->attachRole($studentRole);
        $faculty->attachRole($facultyRole);
        $moduleLeader->attachRole($moduleLeaderRole);

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

        $mod1->users()->attach($student);
        $mod1->users()->attach($student2);
        $mod2->users()->attach($student);

        $work = Work::create(
            [
                'user_id' => 1,
                'module_id' => 1,
                'title' => "Test",
                'description' => 'Test description'
            ]
        );

    }
}
