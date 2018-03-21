<?php

namespace App\Http\Requests\Attachments;

use App\Http\Requests\BaseRequest;

class CreateAttachmentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'application_id' => 'bail|exists:applications,id',
        ];
    }
}