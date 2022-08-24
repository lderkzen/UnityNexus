<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationSubmissionRequest;
use App\Models\ApplicationSubmission;
use App\Models\Feedback;
use App\Models\Group;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ApplicationSubmissionController extends Controller
{

    public function index(Request $request)
    {
        $submissions = ApplicationSubmission::all();

        foreach ($request->input() as $key => $value) {
            $submissions = $submissions->map(fn($submission) => $submission[$key] == $value);
        }

        return Inertia::render('Submissions/Index', [
            'submissions' => $submissions->append(['group', 'applicant', 'status'])
        ]);
    }

    public function show(Request $request, ApplicationSubmission $submission)
    {
        // TODO: Also show 'answers_with_feedback' to management members and above.
        $answers = ($request->user()->id === $submission->applicant_id)
            ? 'answers_with_feedback'
            : 'answers';

        return Inertia::render('Submissions/Details', [
            'submission' => $submission->append(['applicant', 'assigned', 'status', $answers])
        ]);
    }

    public function create(Group $group)
    {
        return Inertia::render('Submissions/CreateEdit', [
            'group' => $group->append(['form'])
        ]);
    }

    public function store(ApplicationSubmissionRequest $request)
    {
        $submission = new ApplicationSubmission();
        $submission->fill($request->input());
        $state = $submission->save();

        if ($state) return Redirect::route('submissions.show', ['submissions' => $submission->id])->with('state', 'Your application has been submitted successfully!');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function edit(ApplicationSubmission $submission)
    {
        $group = $submission->group()->firstOrFail();

        return Inertia::render('Submissions/CreateEdit', [
            'submission' => $submission->append(['status']),
            'group' => $group,
            'form' => $group->questions()->get()->map(fn(Question $question) => $question->answer = $submission->answers()->findOrFail($question->id)
                ->except(['application_submission_id', 'question_id'])->append(['feedback']))
        ]);
    }

    public function update(ApplicationSubmissionRequest $request, ApplicationSubmission $submission)
    {
        $submission->fill($request->input());
        $state = $submission->save();

        if ($state) return Redirect::route('submissions.show', ['submissions' => $submission->id])->with('state', 'Your application has been updated successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function transfer(Request $request, ApplicationSubmission $submission)
    {
        $submission->group_id = $request['group_id'];
        $state = $submission->save();

        if ($state) return Redirect::back(200)->with('state', 'The application has been transferred successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function accept(ApplicationSubmission $submission)
    {
        $submission->status_id = 3;
        $state = $submission->save();

        if ($state) return Redirect::back(200)->with('state', 'The application has been accepted successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function reject(ApplicationSubmission $submission)
    {
        $submission->status_id = 4;
        $state = $submission->save();

        if ($state) return Redirect::back(200)->with('state', 'The application has been denied successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function assign(Request $request, ApplicationSubmission $submission)
    {
        $submission->assigned_id = $request['assigned_id'];
        $state = $submission->save();

        if ($state) return Redirect::back(200)->with('state', 'The application has been assigned successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function review(Request $request)
    {
        $state = false;
        foreach ($request['feedback'] as $entry) {
            $comment = new Feedback();
            $comment->fill($entry);
            $state = $comment->save();
        }

        if ($state) return Redirect::back(200)->with('state', 'The application has been reviewed successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function destroy(ApplicationSubmission $submission)
    {
        $state = $submission->delete();

        if ($state) return Redirect::back(200)->with('state', 'The application has been deleted successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }
}
