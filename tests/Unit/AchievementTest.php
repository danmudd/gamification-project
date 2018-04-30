<?php

namespace Tests\Unit;

use App\Achievements\User15Feedbacks;
use App\Achievements\UserExceptionalFeedback;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AchievementTest extends TestCase
{

    public function test_achievement_is_unlocked()
    {
        /* @var $user User */
        $user = factory(User::class)->create();
        $user->unlock(new UserExceptionalFeedback());
        $this->assertTrue($user->achievementStatus(new UserExceptionalFeedback())->isUnlocked());
    }

    public function test_achievement_isnt_unlocked()
    {
        /* @var $user User */
        $user = factory(User::class)->create();
        $this->assertFalse($user->achievementStatus(new UserExceptionalFeedback())->isUnlocked());
    }

    public function test_achievement_can_be_incremented()
    {
        /* @var $user User */
        $user = factory(User::class)->create();
        $user->setProgress(new User15Feedbacks(), 1);
        $this->assertEquals('1', $user->achievementStatus(new User15Feedbacks())->points);
    }
}
