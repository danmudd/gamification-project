<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    public function getAll($with = array())
    {
        $query = $this->make($with);
        return $query->get();
    }

    public function get($id, $with = array())
    {
        $query = $this->make($with);
        return $query->findOrFail($id);
    }

    public function getAllBy($attribute, $value, $with = array())
    {
        $query = $this->make($with);
        return $query->where($attribute, '=', $value)->get();
    }

    public function getBy($attribute, $value, $with = array())
    {
        $query = $this->make($with);
        return $query->where($attribute, '=', $value)->firstOrFail();
    }

    public function update($thing, $data)
    {
        $thing = $this->model->findOrFail($thing);


        $thing->fill($data);
        $thing->save();

        return $thing;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function delete($thing)
    {
        $thing = $this->model->findOrFail($thing);

        $thing->delete();
    }

    public function next($id)
    {
        return $this->model->where('id', '>', $id)->min('id');
    }

    public function previous($id)
    {
        return $this->model->where('id', '<', $id)->max('id');
    }
}
