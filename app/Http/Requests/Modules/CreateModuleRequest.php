<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\BaseRequest;

class CreateModuleRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'code' => 'bail|required|alpha_num|unique:modules,code',
            'name' => 'bail|required|string',
            'description' => 'bail|nullable|string',
        ];
    }
}