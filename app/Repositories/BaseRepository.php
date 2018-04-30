<?php

namespace App\Repositories;

/**
 * Class BaseRepository
 *
 * A default implementation of repository classes used for transactions
 * Each repository will extend BaseRepository and implement an interface specific to that repository.
 */
abstract class BaseRepository
{
    protected $model;

    /**
     * Prepares a query object from the model
     *
     * @param array $with array of objects to eager load
     * @return mixed
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    /**
     * Gets all objects within a model
     *
     * @param array $with array of objects to eager load
     * @return mixed
     */
    public function getAll($with = array())
    {
        $query = $this->make($with);
        return $query->get();
    }

    /**
     * Gets object with given ID from model
     *
     * @param $id id of object to fetch
     * @param array $with array of objects to eager load
     * @return mixed
     */
    public function get($id, $with = array())
    {
        $query = $this->make($with);
        return $query->findOrFail($id);
    }

    /**
     * Gets all objects within a model with a specified attribute value
     *
     * @param $attribute attribute name to check
     * @param $value value to check against
     * @param array $with array of objects to eager load
     * @return mixed
     */
    public function getAllBy($attribute, $value, $with = array())
    {
        $query = $this->make($with);
        return $query->where($attribute, '=', $value)->get();
    }

    /**
     * Gets first object within a model with a specified attribute value
     *
     * @param $attribute attribute name to check
     * @param $value value to check against
     * @param array $with array of objects to eager load
     * @return mixed
     */
    public function getBy($attribute, $value, $with = array())
    {
        $query = $this->make($with);
        return $query->where($attribute, '=', $value)->firstOrFail();
    }

    /**
     * Updates a model's data
     * @param $thing the object to update
     * @param $data the data to update the object with
     * @return mixed
     */
    public function update($thing, $data)
    {
        $thing = $this->model->findOrFail($thing);

        $thing->fill($data);
        $thing->save();

        return $thing;
    }

    /**
     * Create new object
     *
     * @param $data data of object to create
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Delete an object
     *
     * @param $thing the object to delete
     */
    public function delete($thing)
    {
        $thing = $this->model->findOrFail($thing);

        $thing->delete();
    }

}
