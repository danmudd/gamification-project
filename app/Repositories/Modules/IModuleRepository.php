<?php

namespace App\Repositories\Modules;

interface IModuleRepository
{
    public function getModuleArray();

    public function addUser($module, $thing);

    public function removeUser($module, $thing);
}