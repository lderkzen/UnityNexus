<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        // TODO: Fetch all users from database

        return Inertia::render('Users/Index', [
            'users' => [
                [
                    'id' => 1,
                    'username' => 'Jjampong#1764',
                    'profile_picture' => '',
                    'roles' => [],
                    'application_id' => '',
                    'member_since' => 'yyyy-mm-dd'
                ],
                [
                    'id' => 2,
                    'username' => 'Narys#5109',
                    'profile_picture' => '',
                    'roles' => [],
                    'application_id' => '',
                    'member_since' => 'yyyy-mm-dd'
                ],
                [
                    'id' => 3,
                    'username' => 'Centego Rayven#1185',
                    'profile_picture' => '',
                    'roles' => [],
                    'application_id' => '',
                    'member_since' => 'yyyy-mm-dd'
                ],
            ]
        ]);
    }

    public function show($id)
    {
        // TODO: Fetch correct user from database

        return Inertia::render('Users/Details', [
            'user' => [
                'id' => 1,
                'username' => 'Jjampong#1764',
                'profile_picture' => '',
                'roles' => [],
                'application_id' => '',
                'member_since' => 'yyyy-mm-dd'
            ]
        ]);
    }
}
