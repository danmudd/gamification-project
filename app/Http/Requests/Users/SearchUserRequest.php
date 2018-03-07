<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseRequest;

class SearchUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'bail|alpha',
            'first_name' => 'bail|alpha',
            'last_name' => 'bail|alpha',
        ];
    }
}