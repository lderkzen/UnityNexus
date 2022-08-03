<?php

namespace App\Http\Controllers;

use App\Http\Requests\BanRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BanController extends Controller
{
    public function index()
    {
        //
    }

    public function ban(BanRequest $request, User $user)
    {
        //
    }

    public function unban(User $user)
    {
        //
    }
}
