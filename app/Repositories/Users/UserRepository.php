<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $user = $this->model->create($data);
        $user->password = bcrypt($user->password);
        $user->save();
        $user->attachRole($data['role']);
    }
	
	public function update($thing, $data)
	{
        $thing = $this->model->find($thing);

        $thing->fill($data);
        $thing->save();
		
		$thing->roles()->sync([]);
		$thing->attachRole($data['role']);
	}

    public function search($attributes)
    {
        $results = $this->model->filter($attributes)->get();
        return $results;
    }
}