<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class Login5ConsecutiveDays extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "5 in a row!";

    /*
     * A small description for the achievement
     */
    public $description = "Log in for 5 straight days!";

    public $points = 5;
}
