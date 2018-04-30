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
    /*
    |--------------------------------------------------------------------------
    | Feedback Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles feedback within works. It manages the storage
    | and destruction of feedback. Feedback is loaded dynamically through
    | the Work controller when required.
    |
    */

    protected $feedbacks;

    /**
     * FeedbackController constructor.
     * @param IFeedbackRepository $feedbacks
     */
    public function __construct(IFeedbackRepository $feedbacks)
    {
        $this->feedbacks = $feedbacks;
        $this->middleware('auth');
    }

    /**
     * Stores a piece of feedback.
     *
     * @param CreateFeedbackRequest $request
     * @param Work $work The work object injected by the service container
     */
    public function store(CreateFeedbackRequest $request, Work $work)
    {
        $user = \Auth::user();

        // checks the user can view the work
        if($user->may('show', $work)) {
            $attributes = $request->all();

            // sets default attributes
            $attributes['user_id'] = \Auth::user()->id;
            $attributes['work_id'] = $work->id;
            $feedback = $this->feedbacks->create($attributes);

            // call gamification event
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

    /**
     * Destroys a piece of feedback
     *
     * @param Request $request
     * @param $work id of work feedback belongs to
     * @param $feedback id of feedback to destroy
     */
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
