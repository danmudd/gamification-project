<?php

namespace App\Repositories\Works;

use App\Models\Attachment;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;

class AttachmentRepository extends BaseRepository implements IAttachmentRepository
{
    public function __construct(Attachment $model)
    {
        $this->model = $model;
    }

    public function createAttachment($attributes, $files)
    {
        $attachments = [];
        foreach($files as $file)
        {
            $file = UploadedFile::createFromBase($file);
            $attachment = new Attachment();
            $attachment->work_id = $attributes['work_id'];
            $attachment->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $attachment->path = $file->storeAs('attachments', $file->hashName());
            $attachment->save();

            $attachments[] = $attachment;
        }

        return $attachments;
    }
}