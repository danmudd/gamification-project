<?php

namespace App\Listeners;

use App\Achievements\User15Works;
use App\Achievements\UserFirstWork;
use App\Events\WorkCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkListener
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
     * @param  WorkCreated  $event
     * @return void
     */
    public function handle(WorkCreated $event)
    {
        $work = $event->work;
        $user = $work->user;

        $user->unlock(new UserFirstWork());
        $user->addProgress(new User15Works(), 1);
    }
}
