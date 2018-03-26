<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class User15Feedbacks extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "15 Feedbacks!";

    /*
     * A small description for the achievement
     */
    public $description = "You uploaded 15 pieces of feedback!";

    public $points = 15;
}
