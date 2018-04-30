<?php

namespace App\Repositories\Works;

use App\Models\Attachment;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AttachmentRepository extends BaseRepository implements IAttachmentRepository
{
    public function __construct(Attachment $model)
    {
        $this->model = $model;
    }

    public function delete($thing)
    {
        $thing = $this->model->findOrFail($thing);

        Storage::delete($thing->path);

        $thing->delete();
    }

    public function createAttachment($attributes, $files)
    {
        $attachments = [];
        foreach($files as $file)
        {
            // convert symfony file into laravel file
            $file = UploadedFile::createFromBase($file);
            // create new model instance
            $attachment = new Attachment();
            $attachment->work_id = $attributes['work_id'];
            // get filename from original upload
            $attachment->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // store file in filesystem and destroy it
            $attachment->path = $file->storeAs('attachments', $file->hashName());
            $attachment->save();

            $attachments[] = $attachment;
        }

        return $attachments;
    }
}