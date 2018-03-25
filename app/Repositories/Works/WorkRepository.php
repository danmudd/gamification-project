<?php

namespace App\Repositories\Works;

use App\Models\Work;
use App\Repositories\BaseRepository;

class WorkRepository extends BaseRepository implements IWorkRepository
{
    public function __construct(Work $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $work = new Work();
        $work->fill($data);
        $work->user_id = \Auth::id();
        $work->save();

        return $work;
    }
}