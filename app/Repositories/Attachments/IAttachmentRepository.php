<?php

namespace App\Repositories\Attachments;

interface IAttachmentRepository
{
    public function createAttachment($attributes, $files);
}