<?php

namespace App\Http\Controllers;

use App\Repositories\Works\IAttachmentRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Attachments\CreateAttachmentRequest;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Attachment Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles attachments within works. It automatically
    | stores attachments within the filesystem when called.
    |
    */

    protected $attachments;

    /**
     * AttachmentController constructor.
     * @param IAttachmentRepository $attachments injected via the service controller
     */
    public function __construct(IAttachmentRepository $attachments)
    {
        $this->attachments = $attachments;
        $this->middleware('auth');
    }

    /**
     * Store a new attachment(s) in the database.
     *
     * @param CreateAttachmentRequest $request
     */
    public function store(CreateAttachmentRequest $request)
    {
        $files = $request->files;
        $attributes = $request->all();
        $attachment = $this->attachments->createAttachment($attributes, $files);

        return redirect()->route('works.show', ['id' => $attributes['work_id']]);
    }

    /**
     * Fetches an attachment from the filesystem
     *
     * @param $work id for the work
     * @param $id id for the attachment
     */
    public function show($work, $id)
    {
        $attachment = $this->attachments->make()->where('work_id', $work)->findOrFail($id);

        // loads the file from local storage
        $file = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($attachment->path);
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        // returns the file to the client in a new tab
        return response()->download($file, $attachment->name . ".{$ext}", [], 'inline');
    }

    /**
     * Destroys a stored attachment
     *
     * @param Request $request
     * @param $work id of the work
     * @param $id id of the attachment
     */
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
