<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function show()
    {
        return Inertia::render('App');
    }
}
