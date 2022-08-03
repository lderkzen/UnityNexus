<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

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
        return Inertia::render('Groups/Create');
    }

    public function store(GroupRequest $request)
    {
        $group = Group::create([
            'supergroup_id' => $request->supergroup_id ?? null,
            'channel_id' => $request->channel_id ?? null,
            'name' => $request->name,
            'description' => $request->description ?? null,
        ]);

        return Redirect::to("/groups/{$group->id}");
    }

    public function show(Group $group)
    {
        return Inertia::render('Groups/Details', [
            'group' => $group
        ]);
    }

    public function edit(Group $group) {
        return Inertia::render('Groups/Edit', [
            'group' => $group
        ]);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->supergroup_id = $request->supergroup_id ?? null;
        $group->channel_id = $request->channel_id ?? null;
        $group->name = $request->name;
        $group->description = $request->description ?? null;
        $group->recruiting = $request->recruiting;

        $group->save();

        return Redirect::to("/groups/{$group->id}");
    }

    public function attach(GroupRequest $request, Group $group)
    {
        //
    }

    public function detach(GroupRequest $request, Group $group)
    {
        //
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return Redirect::to('/groups');
    }
}
