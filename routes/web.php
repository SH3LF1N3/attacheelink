<?php

use App\Http\Controllers\Alink;
use App\Http\Controllers\Home;
use App\Http\Controllers\dash\Dashboard;
use App\Http\Controllers\dash\Opportunity;
use App\Http\Controllers\dash\Apps;
use App\Http\Controllers\dash\Students;
use App\Http\Controllers\dash\Notifications;
use App\Http\Controllers\dash\Organisations;
use App\Http\Controllers\dash\Reports;
use App\Http\Controllers\dash\Settings;
use App\Http\Controllers\dash\Aitools;
use Illuminate\Support\Facades\Route;

// ── Public ────────────────────────────────────────────────────────────────────

Route::get('/', [Home::class, 'index'])->name('home');

// ── Guest only (redirect to dashboard if already logged in) ───────────────────

Route::middleware('guest')->group(function () {
    Route::get( '/login',    [Alink::class, 'index'])->name('login');
    Route::post('/login',    [Alink::class, 'login'])->name('login.post');
    Route::get( '/register', [Alink::class, 'register'])->name('register');
    Route::post('/register', [Alink::class, 'store'])->name('register.post');
});

// ── Logout (POST only, auth required) ─────────────────────────────────────────

Route::post('/logout', [Alink::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ── Protected — all routes below require login ────────────────────────────────

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [Dashboard::class, 'dash'])->name('dashboard');
    Route::get('/profile',   [Dashboard::class, 'profile'])->name('profile');

    Route::get('/opportunities',  [Opportunity::class,    'oppo'])->middleware('permission:oppo')->name('opportunities');
    Route::get('/applications',   [Apps::class,           'app'])->middleware('permission:app')->name('applications');
    Route::get('/students',       [Students::class,       'students'])->middleware('permission:stud')->name('students');
    Route::get('/notifications',  [Notifications::class,  'notify'])->middleware('permission:not')->name('notifications');
    Route::get('/organisations',  [Organisations::class,  'org'])->middleware('permission:org')->name('organisations');
    Route::get('/reports',        [Reports::class,        'reports'])->middleware('permission:rep')->name('reports');

    Route::get('/permission_settings', [Settings::class, 'permit'])->middleware('permission:set')->name('permission_settings');
    Route::get('/system_logs',         [Settings::class, 'logs'])->middleware('permission:set')->name('system_logs');
    Route::get('/general_settings',    [Settings::class, 'gen'])->middleware('permission:set')->name('general_settings');

    Route::get('/ai_assistant',      [Aitools::class, 'ass'])->middleware('permission:ait')->name('ai_assistant');
    Route::get('/ai_resume_checker', [Aitools::class, 'check'])->middleware('permission:air')->name('ai_resume_checker');

});