<?php

namespace App\Repositories\Works;

interface IAttachmentRepository
{
    public function createAttachment($attributes, $files);
}