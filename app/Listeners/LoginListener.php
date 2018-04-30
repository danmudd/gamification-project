<?php

namespace App\Listeners;

use App\Achievements\Login5ConsecutiveDays;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $achievement = new Login5ConsecutiveDays();

        $user = $event->user;

        // code for consecutive logins
        $daydiff = isset($user->last_login) ? $user->last_login->diffInDays(Carbon::now()) : 1;

        if($daydiff == 1)
        {
            $user->addProgress($achievement, 1);
        }
        else if($daydiff > 1)
        {
            $user->resetProgress($achievement);
            $user->addProgress($achievement, 1);
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();
    }
}
