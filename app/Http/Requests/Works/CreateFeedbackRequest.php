<?php

namespace App\Http\Requests\Works;

use App\Http\Requests\BaseRequest;

class CreateFeedbackRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'work_id' => 'bail|required|exists:works,id',
        ];
    }
}