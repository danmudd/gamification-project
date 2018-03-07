<?php

namespace App\Http\Requests\Roles;

use App\Http\Requests\BaseRequest;

class CreateRoleRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'bail|required|alpha|unique:roles,name',
            'display_name' => 'bail|nullable|alpha',
            'description' => 'bail|nullable|string',
        ];
    }
}