<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserFirstWork extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Baby Steps";

    /*
     * A small description for the achievement
     */
    public $description = "You uploaded your first piece of work!";
}
