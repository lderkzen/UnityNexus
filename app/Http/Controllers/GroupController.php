<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Inertia\Inertia;

class GroupController extends Controller
{
    public function index()
    {
        return Inertia::render('Groups/Index', [
            'groups' => Group::all()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(GroupRequest $request)
    {
        //
    }

    public function show(Group $group)
    {
        //
    }

    public function edit(Group $group) {
        // TODO: Return application attached to category from DB

        return Inertia::render('Groups/Edit', [
            'id' => 1,
            'name' => 'Social',
            'member_count' => 100,
            'application_id' => '',
            'status' => 'OPEN',
        ]);
    }

    public function update(GroupRequest $request, Group $group)
    {
        //
    }

    public function destroy(Group $group)
    {
        //
    }
}
