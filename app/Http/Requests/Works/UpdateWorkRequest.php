<?php

namespace App\Http\Requests\Works;

use App\Http\Requests\BaseRequest;

class UpdateWorkRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'id' => 'bail|exists:works,id',
            'module_id' => 'bail|required|exists:roles,id',
            'title' => 'bail|required|string',
            'description' => 'bail|nullable|string'
        ];
    }
}
