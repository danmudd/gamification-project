<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class User15Works extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "15 Works!";

    /*
     * A small description for the achievement
     */
    public $description = "You uploaded 15 pieces of work!";

    public $points = 15;
}
