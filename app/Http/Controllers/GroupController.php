<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Channel;
use App\Models\Group;
use App\Models\Supergroup;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class GroupController extends Controller
{
    public function index()
    {
        return Inertia::render('Groups/Index', [
            'supergroups' => Supergroup::orderBy('position')->get()->append(['groups']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Groups/CreateEdit', [
            'channels' => Channel::where('type_id', '=', '0')->orderBy('position', 'asc')->get()
        ]);
    }

    public function store(GroupRequest $request)
    {
        $group = new Group();
        $group->fill($request->input());
        $group->save();

        return Redirect::route('groups.index')->with('state', 'The group has been created successfully!');
    }

    public function edit(Group $group)
    {
        $group->channel = $group->getAttribute('channel');
        $group->form = $group->getAttribute('form');

        return Inertia::render('Groups/CreateEdit', [
            'group' => $group,
            'channels' => Channel::where('type_id', '=', '0')->orderBy('position', 'asc')->get()
        ]);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->fill($request->input());
        $group->save();

        return Redirect::route('groups.index')->with('state', 'The group has been updated successfully.');
    }

    public function attach(GroupRequest $request, Group $group)
    {
        $group->supergroup_id = $request['supergroup_id'];
        $group->save();

        return Redirect::route('groups.index')->with('state', 'The group has been attached successfully.');
    }

    public function detach(Group $group)
    {
        $group->supergroup_id = 1;
        $group->save();

        return Redirect::route('groups.index')->with('state', 'The group has been detached successfully.');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return Redirect::route('groups.index')->with('state', 'The group has been deleted successfully.');
    }
}
