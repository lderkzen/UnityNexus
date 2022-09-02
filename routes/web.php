<?php

use App\Http\Controllers\ApplicationSubmissionController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\BanController;
use App\Http\Controllers\BlacklistController;
use App\Http\Controllers\DiscordAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\SupergroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ApplicationController;
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

Route::get('/login', [DiscordAuthController::class, 'show'])->name('auth.login');
Route::get('/auth/discord/redirect', [DiscordAuthController::class, 'redirectToDiscordProvider'])->name('auth.discord.redirect');
Route::get('/auth/discord/callback', [DiscordAuthController::class, 'handleDiscordProviderCallback'])->name('auth.discord.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'show'])->name('home');
    Route::post('/logout', [DiscordAuthController::class, 'logout'])->name('auth.logout');
    Route::post('/theme/toggle', [HomeController::class, 'toggleTheme'])->name('toggle.theme');
    Route::get('/auditlog', [AuditLogController::class, 'index'])->name('audit_log.index');

    // Member Routes
    Route::get('/members', [UserController::class, 'index'])->name('members.index');
    Route::get('/members/{user}', [UserController::class, 'show'])->name('members.show')
        ->whereNumber('user');
    Route::get('/members/bans', [BanController::class, 'index'])->name('bans.index')
        ->whereNumber('user');
    Route::post('/members/{user}/ban', [BanController::class, 'ban'])->name('members.ban')
        ->whereNumber('user');
    Route::delete('/members/{user}/unban', [BanController::class, 'unban'])->name('members.unban')
        ->whereNumber('user');

    // Blacklist Routes
    Route::get('/blacklist', [BlacklistController::class, 'index'])->name('blacklist.index');
    Route::post('/blacklist', [BlacklistController::class, 'store'])->name('blacklist.store');
    Route::delete('/blacklist', [BlacklistController::class, 'destroy'])->name('blacklist.destroy');

    // Group Routes
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create')
        ->whereNumber('group');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store')
        ->whereNumber('group');
    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit')
        ->whereNumber('group');
    Route::put('/groups/{group}', [GroupController::class, 'update'])->name('groups.update')
        ->whereNumber('group');
    Route::put('/groups/{group}/attach', [GroupController::class, 'attach'])->name('groups.attach')
        ->whereNumber('group');
    Route::put('/groups/{group}/detach', [GroupController::class, 'detach'])->name('groups.detach')
        ->whereNumber('group');
    Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');

    // Application Routes
    Route::get('/groups/{group}/application', [ApplicationController::class, 'show'])->name('groups.application.show')
        ->whereNumber('group');
    Route::get('/groups/{group}/application/edit', [ApplicationController::class, 'edit'])->name('groups.application.edit')
        ->whereNumber('group');
    Route::put('/groups/{group}/application', [ApplicationController::class, 'update'])->name('groups.application.update')
        ->whereNumber('group');

    // Submission Routes
    Route::get('/submissions', [ApplicationSubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/submissions/{submission}', [ApplicationSubmissionController::class, 'show'])->name('submissions.show')
        ->whereNumber('submission');
    Route::get('/groups/{group}/apply', [ApplicationSubmissionController::class, 'create'])->name('groups.application.create')
        ->whereNumber('group');
    Route::put('/groups/{group}/apply', [ApplicationSubmissionController::class, 'store'])->name('groups.application.apply')
        ->whereNumber('group');
    Route::get('/submissions/{submission}/edit', [ApplicationSubmissionController::class, 'edit'])->name('submissions.edit')
        ->whereNumber('submission');
    Route::put('/submissions/{submission}', [ApplicationSubmissionController::class, 'update'])->name('submissions.update')
        ->whereNumber('submission');
    Route::put('/submissions/{submission}/transfer', [ApplicationSubmissionController::class, 'transfer'])->name('submissions.transfer')
        ->whereNumber('submission');
    Route::put('/submissions/{submission}/accept', [ApplicationSubmissionController::class, 'accept'])->name('submissions.accept')
        ->whereNumber('submission');
    Route::put('/submissions/{submission}/reject', [ApplicationSubmissionController::class, 'reject'])->name('submissions.reject')
        ->whereNumber('submission');
    Route::put('/submissions/{submission}/assign', [ApplicationSubmissionController::class, 'assign'])->name('submissions.assign')
        ->whereNumber('submission');
    Route::put('/submissions/{submission}/review', [ApplicationSubmissionController::class, 'review'])->name('submissions.review')
        ->whereNumber('submission');
    Route::delete('/submissions/{submission}', [ApplicationSubmissionController::class, 'destroy'])->name('submissions.destroy')
        ->whereNumber('submission');
});
