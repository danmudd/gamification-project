<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Work;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkTest extends TestCase
{
    public function test_can_work_be_created()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('name', $work->name);
    }
}
