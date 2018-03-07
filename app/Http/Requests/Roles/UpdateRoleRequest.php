<?php

namespace App\Http\Requests\Roles;

use App\Http\Requests\BaseRequest;

class UpdateRoleRequest extends BaseRequest
{
    public function rules()
    {
        $id = $this->id;
        return [
            'id' => 'bail|exists:roles,id',
            'name' => 'bail|alpha|unique:roles,name,' . $id,
            'display_name' => 'bail|nullable|alpha',
            'description' => 'bail|nullable|string'
        ];
    }
}