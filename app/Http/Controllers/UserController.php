<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Requests\BanRequest;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::all()
        ]);
    }

    public function show($id)
    {
        if (!($user = User::find($id)))
            return Redirect::back('404')->withErrors('User not found.');

        return Inertia::render('Users/Details', [
            'user' => $user
        ]);
    }

    public function ban(BanRequest $request, $id) {

    }
}
