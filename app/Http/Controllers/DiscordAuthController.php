<?php

namespace App\Http\Controllers;

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
    $user = Socialite::driver('discord')->user();

    // TODO: Check if user exists within HoU database. and set $user to user fetched from database.

    return Redirect::to('/');
  }
}
