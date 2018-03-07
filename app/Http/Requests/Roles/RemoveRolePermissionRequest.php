<?php

namespace App\Http\Requests\Roles;

use App\Http\Requests\BaseRequest;

class RemoveRolePermissionRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'role_id' => 'bail|exists:roles,id',
            'permission' => 'bail|exists:permissions,id'
        ];
    }
}