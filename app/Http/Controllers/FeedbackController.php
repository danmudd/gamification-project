<?php

namespace App\Http\Controllers;

use App\Events\FeedbackCreated;
use App\Http\Requests\Works\CreateFeedbackRequest;
use App\Models\Work;
use App\Repositories\Works\IFeedbackRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $feedbacks;

    public function __construct(IFeedbackRepository $feedbacks)
    {
        $this->feedbacks = $feedbacks;
        $this->middleware('auth');
    }

    public function store(CreateFeedbackRequest $request, Work $work)
    {
        $user = \Auth::user();

        if($user->may('show', $work)) {
            $attributes = $request->all();

            $attributes['user_id'] = \Auth::user()->id;
            $attributes['work_id'] = $work->id;
            $feedback = $this->feedbacks->create($attributes);

            event(new FeedbackCreated($feedback));

            if ($request->ajax()) {
                return response()->json();
            }

            return redirect()->route('works.show', ['id' => $feedback->work_id]);
        }
        else
        {
            return redirect()->route('works.index');
        }
    }

    public function destroy(Request $request, $work, $feedback)
    {
        $this->feedbacks->delete($feedback);

        if($request->ajax())
        {
            return response()->json();
        }

        return redirect()->route('works.show', ['id' => $work]);
    }
}
