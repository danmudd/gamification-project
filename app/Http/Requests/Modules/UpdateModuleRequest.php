<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\BaseRequest;

class UpdateModuleRequest extends BaseRequest
{
    public function rules()
    {
        $id = $this->id;
        return [
            'id' => 'bail|exists:roles,id',
            'code' => 'bail|required|alpha|unique:modules,code,' . $id,
            'name' => 'bail|required|alpha',
            'description' => 'bail|nullable|string'
        ];
    }
}