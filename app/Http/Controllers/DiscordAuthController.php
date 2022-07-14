<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class DiscordAuthController extends Controller
{
    public function show()
    {
        return Inertia::render('Auth/Login');
    }

    public function redirectToDiscordProvider()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordProviderCallback()
    {
        $user = Socialite::driver('discord')
            ->scopes(['identify'])
            ->user();

        if (!$user->user->verified)
            return Redirect::to('/login', 400)->withErrors('Unverified Discord account.');

        $user = User::find($user->id);

        if ($user) {
            Auth::login($user);
            return Redirect::to('/');
        } else
            return Redirect::to('/login', 400)->withErrors('User is not part of the Hand of Unity discord server.');
    }
}
