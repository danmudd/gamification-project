<?php

namespace App\Http\Controllers;

use App\Repositories\Works\IAttachmentRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Attachments\CreateAttachmentRequest;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    protected $attachments;

    public function __construct(IAttachmentRepository $attachments)
    {
        $this->attachments = $attachments;
        $this->middleware('auth');
    }

    public function store(CreateAttachmentRequest $request)
    {
        $files = $request->files;
        $attributes = $request->all();
        $attachment = $this->attachments->createAttachment($attributes, $files);

        return redirect()->route('works.show', ['id' => $attributes['work_id']]);
    }

    public function show($work, $id)
    {
        $attachment = $this->attachments->make()->where('work_id', $work)->findOrFail($id);

        $file = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($attachment->path);
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        return response()->download($file, $attachment->name . ".{$ext}", [], 'inline');
    }

    public function destroy(Request $request, $work, $id)
    {
        $this->attachments->delete($id);

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->route('works.show', ['id' => $work]);
    }
}
