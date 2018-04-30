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

    /**
     * @param array $with array of models to eager load
     * @return mixed array of id to module and code
     */
    public function getModuleArray($with = array())
    {
        $stuff = $this->getAll();

        return $stuff->mapWithKeys(function($item)
        {
            return [$item->id => $item->name . ': ' . $item->code];
        });
    }

    /**
     * Adds a user to a module
     *
     * @param $module module to add user to
     * @param $thing User to add
     */
    public function addUser($module, $thing)
    {
        $module = $this->model->find($module);

        $module->users()->attach(array_keys($thing["users"]));
    }

    /**
     * Removes a user from a module
     *
     * @param $module module to remove a user from
     * @param $thing user to remove
     */
    public function removeUser($module, $thing)
    {
        $module = $this->model->find($module);

        $module->users()->detach($thing);
    }
}