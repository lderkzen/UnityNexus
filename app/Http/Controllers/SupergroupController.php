<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupergroupRequest;
use App\Models\Supergroup;
use Inertia\Inertia;

class SupergroupController extends Controller
{
    public function index()
    {
        return Inertia::render('Supergroups/Index', [
            'supergroups' => Supergroup::all()
        ]);
    }

    public function store(SupergroupRequest $request, Supergroup $supergroup)
    {
        //
    }

    public function destroy(Supergroup $supergroup)
    {
        //
    }
}
