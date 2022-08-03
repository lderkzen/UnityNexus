<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function show()
    {
        return Inertia::render('App');
    }

    public function toggleTheme(Request $request)
    {

    }
}
