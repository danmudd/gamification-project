<?php

namespace App\Repositories\Works;

use App\Models\Feedback;
use App\Repositories\BaseRepository;

class FeedbackRepository extends BaseRepository implements IFeedbackRepository
{
    public function __construct(Feedback $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $feedback = new Feedback();
        $feedback->fill($data);
        $feedback->user_id = \Auth::id();
        $feedback->save();

        return $feedback;
    }

}