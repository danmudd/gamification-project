<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\BaseRequest;

class AddModuleUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'module_id' => 'bail|exists:modules,id',
            'users' => 'bail|required|array',
            'users.*' => 'bail|unique:users,id'
        ];
    }
}