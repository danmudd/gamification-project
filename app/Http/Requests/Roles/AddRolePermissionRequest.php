<?php

namespace App\Http\Requests\Roles;

use App\Http\Requests\BaseRequest;

class AddRolePermissionRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'role_id' => 'bail|exists:roles,id',
            'permission' => 'bail|exists:permissions,id|unique:permission_role,permission_id,NULL,NULL,role_id,' . $this->role_id,
        ];
    }
}