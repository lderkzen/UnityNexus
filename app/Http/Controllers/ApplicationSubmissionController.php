<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationSubmissionRequest;
use App\Http\Requests\UpdateApplicationSubmissionRequest;
use App\Models\Answer;
use App\Models\ApplicationSubmission;
use App\Models\Feedback;
use App\Models\Group;
use App\Models\Question;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ApplicationSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $submissions = ApplicationSubmission::all()->append(['group', 'applicant', 'status']);

        foreach ($request->input() as $key => $value) {
            $submissions = $submissions->map(fn($submission) => $submission[$key] == $value);
        }

        return Inertia::render('Submissions/Index', [
            'submissions' => $submissions
        ]);
    }

    public function show(Request $request, ApplicationSubmission $submission)
    {
        // TODO: Also show 'answers_with_feedback' to management members and above.
        $answers = ($request->user()->id === $submission->applicant_id)
            ? 'answers_with_feedback'
            : 'answers';

        $submission->applicant = $submission->getAttribute('applicant');
        $submission->assigned = $submission->getAttribute('assigned');
        $submission->status = $submission->getAttribute('status');
        $submission->answers = $submission->getAttribute($answers);

        return Inertia::render('Submissions/Details', [
            'submission' => $submission
        ]);
    }

    public function create(Group $group)
    {
        $group->form = $group->getFormAttribute();

        return Inertia::render('Submissions/CreateEdit', [
            'group' => $group
        ]);
    }

    public function store(StoreApplicationSubmissionRequest $request, Group $group)
    {
        $submission = new ApplicationSubmission();
        $submission->group_id = $group->id;
        $submission->applicant_id = $request->user()->id;
        $submission->fill($request->except('answers'));
        $submission->save();

        foreach ($request['answers'] as $input) {
            $answer = new Answer([
                'application_submission_id' => $submission->id,
                'question_id' => $input['question_id'],
                'question' => Question::find($input['question_id'])->question,
                'answer' => $input['answer']
            ]);
            $answer->save();
        }

        return Redirect::route('submissions.show', ['submission' => $submission->id])->with('state', 'Your application has been submitted successfully!');
    }

    public function edit(ApplicationSubmission $submission)
    {
        $submission->status = $submission->getAttribute('status');

        return Inertia::render('Submissions/CreateEdit', [
            'submission' => $submission->append(['status']),
            'group' => $submission->group()->firstOrFail(),
            'form' => $submission->answers()->get()->append(['position', 'feedback']),
        ]);
    }

    public function update(UpdateApplicationSubmissionRequest $request, ApplicationSubmission $submission)
    {
        $status = Status::where('status', '=', 'REFINEMENT')->first();

        if ($status && $submission->status_id === $status->id) {
            $submission->fill($request->only(['public', 'age', 'location']));
            $submission->status_id = Status::where('status', '=', 'PENDING')->first()->id;
            $submission->save();

            if ($request->has('answers'))
            {
                $answers = $submission->answers()->get();
                foreach ($answers as $old_answer) {
                    foreach ($request['answers'] as $input) {
                        if ($old_answer->question_id == $input['question_id'])
                            $old_answer->answer = $input['answer'];
                    }
                    $old_answer->save();
                }
            }
        } else if ($request->exists('public')) {
            $submission->public = $request['public'];
            $submission->save();
        } else {
            return Redirect::back(500)->withErrors('state', 'The submitted application cannot be edited at this time.');
        }

        return Redirect::route('submissions.show', ['submission' => $submission->id])->with('state', 'Your application has been updated successfully.');
    }

    public function transfer(Request $request, ApplicationSubmission $submission)
    {
        $submission->group_id = $request['group_id'];
        $submission->save();

        return Redirect::back()->with('state', 'The application has been transferred successfully.');
    }

    public function accept(ApplicationSubmission $submission)
    {
        $submission->status_id = 3;
        $submission->save();

        return Redirect::back()->with('state', 'The application has been accepted successfully.');
    }

    public function reject(ApplicationSubmission $submission)
    {
        $submission->status_id = 4;
        $submission->save();

        return Redirect::back()->with('state', 'The application has been denied successfully.');
    }

    public function assign(Request $request, ApplicationSubmission $submission)
    {
        $submission->assigned_id = $request['assigned_id'];
        $submission->save();

        return Redirect::back()->with('state', 'The application has been assigned successfully.');
    }

    public function review(Request $request)
    {
        foreach ($request['feedback'] as $entry) {
            $comment = new Feedback();
            $comment->fill($entry);
            $comment->save();
        }

        return Redirect::back()->with('state', 'The application has been reviewed successfully.');
    }

    public function destroy(ApplicationSubmission $submission)
    {
        $submission->delete();

        return Redirect::back()->with('state', 'The application has been deleted successfully.');
    }
}
