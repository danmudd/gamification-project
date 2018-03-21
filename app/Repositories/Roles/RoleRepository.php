<?php

namespace App\Repositories\Roles;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements IRoleRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
	
	public function getRoleArray()
	{
		$stuff = $this->getAll();
		
		return $stuff->mapWithKeys(function($item) 
		{
            return [$item->id => ($item->display_name ? $item->display_name : $item->name)];
        });
	}

    public function addPermission($role, $thing)
    {
        $role = $this->model->find($role);

        $role->attachPermission($thing['permission']);
    }

    public function removePermission($role, $thing)
    {
        $role = $this->model->find($role);

        $role->detachPermission($thing);
    }
}