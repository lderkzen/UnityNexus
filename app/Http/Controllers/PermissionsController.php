<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionsRequest;
use App\Models\PermissionFlag;
use App\Models\Role;
use Inertia\Inertia;

class PermissionsController extends Controller
{
    public function edit()
    {
        $roles = Role::all();

        dd($roles);

        $unused = [];
        $flagged = [];

        return Inertia::render('Permissions/Edit', [
            'unused_roles' => [],
            'flagged_roles' => [],
            'flags' => PermissionFlag::all()
        ]);
    }

    public function update(PermissionsRequest $request)
    {

    }

    public function clear(Role $role)
    {
        //
    }
}
