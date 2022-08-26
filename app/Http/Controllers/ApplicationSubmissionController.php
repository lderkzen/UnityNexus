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
        //
    }

    public function show(Request $request, ApplicationSubmission $submission)
    {
        //
    }

    public function create(Group $group)
    {
        //
    }

    public function store(ApplicationSubmissionRequest $request)
    {
        //
    }

    public function edit(ApplicationSubmission $submission)
    {
        //
    }

    public function update(ApplicationSubmissionRequest $request, ApplicationSubmission $submission)
    {
        //
    }

    public function transfer(Request $request, ApplicationSubmission $submission)
    {
        //
    }

    public function accept(ApplicationSubmission $submission)
    {
        //
    }

    public function reject(ApplicationSubmission $submission)
    {
        //
    }

    public function assign(Request $request, ApplicationSubmission $submission)
    {
        //
    }

    public function review(Request $request)
    {
        //
    }

    public function destroy(ApplicationSubmission $submission)
    {
        //
    }
}
