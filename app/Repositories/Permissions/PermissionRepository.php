<?php

namespace App\Repositories\Permissions;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements IPermissionRepository
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function getPermissionArray()
    {
        $stuff = $this->getAll();

        return $stuff->mapWithKeys(function($item)
        {
            return [$item->id => ($item->display_name ? $item->display_name : $item->name)];
        });
    }
}