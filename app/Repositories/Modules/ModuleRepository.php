<?php

namespace App\Repositories\Modules;

use App\Models\Module;
use App\Repositories\BaseRepository;

class ModuleRepository extends BaseRepository implements IModuleRepository
{
    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function getModuleArray($with = array())
    {
        $stuff = $this->getAll();

        return $stuff->mapWithKeys(function($item)
        {
            return [$item->id => $item->name . ': ' . $item->code];
        });
    }

    public function addUser($module, $thing)
    {
        $module = $this->model->find($module);

        $module->members()->attach(array_keys($thing["users"]));
    }

    public function removeUser($module, $thing)
    {
        $module = $this->model->find($module);

        $module->members()->detach($thing);
    }
}