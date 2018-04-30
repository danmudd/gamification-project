<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    public function rules()
    {
        $id = $this->id;
        return [
            'id' => 'bail|exists:users,id',
            'username' => 'bail|required|alpha_dash|unique:users,username,' . $id,
            'email' => 'bail|email|unique:users,email,' . $id,
            'password' => 'bail|confirmed',
			'role' => 'bail|exists:roles,id'
        ];
    }
}