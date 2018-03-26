<?php

namespace App\Listeners;

use App\Achievements\FeedbackWorkWithNoFeedback;
use App\Achievements\User15Feedbacks;
use App\Achievements\UserFirstFeedback;
use App\Events\FeedbackCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackListener
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
     * @param  FeedbackLeft  $event
     * @return void
     */
    public function handle(FeedbackCreated $event)
    {
        $feedback = $event->feedback;

        $user = $feedback->user;

        $user->unlock(new UserFirstFeedback());
        $user->addProgress(new User15Feedbacks(), 1);

        $req = $feedback->work()->withCount('feedbacks')->first();
        if($req->feedbacks_count == 1)
        {
            $user->unlock(new FeedbackWorkWithNoFeedback());
        }
    }
}
