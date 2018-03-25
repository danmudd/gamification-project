<?php

namespace App\Http\Requests\Works;

use App\Http\Requests\BaseRequest;

class CreateWorkRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'module_id' => 'bail|required|exists:roles,id',
            'title' => 'bail|required|string',
            'description' => 'bail|nullable|string'
        ];
    }
}