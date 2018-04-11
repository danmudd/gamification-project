<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\BaseRequest;

class UpdateModuleRequest extends BaseRequest
{
    public function rules()
    {
        $id = $this->id;
        return [
            'id' => 'bail|exists:modules,id',
            'code' => 'bail|required|alpha_num|unique:modules,code,' . $id,
            'name' => 'bail|required|string',
            'description' => 'bail|nullable|string'
        ];
    }
}