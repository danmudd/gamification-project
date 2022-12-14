<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseRequest;

class CreateUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'username' => 'bail|required|alpha_dash|unique:users,username',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required|confirmed',
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
			'role' => 'bail|exists:roles,id'
        ];
    }
}