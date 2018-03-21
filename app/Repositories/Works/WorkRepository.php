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
}