<?php

use App\Http\Controllers\DiscordAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/login', [DiscordAuthController::class, 'show'])->name('auth.login');
Route::get('/auth/discord/redirect', [DiscordAuthController::class, 'redirectToDiscordProvider'])->name('auth.discord.redirect');
Route::get('/auth/discord/callback', [DiscordAuthController::class, 'handleDiscordProviderCallback'])->name('auth.discord.callback');

// TODO: Add auth middleware.
Route::get('/members', [UserController::class, 'index'])->name('members.index');
Route::get('/members/{id}', [UserController::class, 'show'])->name('members.details');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
