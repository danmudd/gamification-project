<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Roles\RoleRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as Faker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $faker = Faker::create();
    }

}
