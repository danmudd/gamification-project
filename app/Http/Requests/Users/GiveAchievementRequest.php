<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseRequest;

class GiveAchievementRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'achievement' => 'bail|required|exists:achievement_details,class_name'
        ];
    }
}