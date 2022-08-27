<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Channel;
use App\Models\Group;
use App\Models\Supergroup;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

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
            'channels' => Channel::where('type_id', '=', '0')->get()
        ]);
    }

    public function store(GroupRequest $request)
    {
        $group = new Group();
        $group->fill($request->input());
        $state = $group->save();

        if ($state) return Redirect::route('groups.index')->with('state', 'The group has been created successfully!');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function edit(Group $group)
    {
        $group->channel = $group->getAttribute('channel');
        $group->form = $group->getAttribute('form');

        return Inertia::render('Groups/CreateEdit', [
            'group' => $group,
            'channels' => Channel::where('type_id', '=', '0')->get()
        ]);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->fill($request->input());
        $state = $group->save();

        if ($state) return Redirect::route('groups.index')->with('state', 'The group has been updated successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function attach(GroupRequest $request, Group $group)
    {
        $group->supergroup_id = $request['supergroup_id'];
        $state = $group->save();

        if ($state) return Redirect::back(200)->with('state', 'The group has been attached successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function detach(Group $group)
    {
        $group->supergroup_id = 1;
        $state = $group->save();

        if ($state) return Redirect::back(200)->with('state', 'The group has been detached successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }

    public function destroy(Group $group)
    {
        $state = $group->delete();

        if ($state) return Redirect::back(200)->with('state', 'The group has been deleted successfully.');
        else return Redirect::back(500)->withErrors('state', 'Oops... Something went wrong, please notify a moderator.');
    }
}
