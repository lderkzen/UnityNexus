<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationSubmissionRequest;
use App\Models\ApplicationSubmission;
use App\Models\Group;
use Illuminate\Http\Request;

class ApplicationSubmissionController extends Controller
{

    public function index()
    {
        //
    }

    public function show(ApplicationSubmission $submission)
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

    public function transfer(ApplicationSubmission $submission)
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

    public function assign(ApplicationSubmission $submission)
    {
        //
    }

    public function review(ApplicationSubmission $submission)
    {
        //
    }

    public function destroy(ApplicationSubmission $submission)
    {
        //
    }
}
