<?php

use App\Http\Controllers\Alink;
use App\Http\Controllers\Home;
use App\Http\Controllers\AboutUs;
use App\Http\Controllers\ContactUs;
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

// Public 

Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/aboutus', [AboutUs::class, 'index'])->name('aboutus');
Route::get('/contactus', [ContactUs::class, 'index'])->name('contactus');
Route::post('/contactus', [ContactUs::class, 'send'])->name('contactus.send');

// Guest only 

Route::middleware('guest')->group(function () {
    Route::get( '/login',    [Alink::class, 'index'])->name('login');
    Route::post('/login',    [Alink::class, 'login'])->name('login.post');
    Route::get( '/register', [Alink::class, 'register'])->name('register');
    Route::post('/register', [Alink::class, 'store'])->name('register.post');
});

// Logout

Route::post('/logout', [Alink::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Protected 

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [Dashboard::class, 'dash'])
        ->middleware('role.redirect')
        ->name('dashboard');

    Route::get('/profile', [Dashboard::class, 'profile'])->name('profile');

    // Core sections
    Route::get('/opportunities',  [Opportunity::class,   'oppo'])->middleware('permission:oppo')->name('opportunities');
    Route::get('/applications',   [Apps::class,          'app'])->middleware('permission:app')->name('applications');
    Route::get('/students',       [Students::class,      'students'])->middleware('permission:stud')->name('students');
    Route::get('/notifications',  [Notifications::class, 'notify'])->middleware('permission:not')->name('notifications');
    Route::get('/organisations',  [Organisations::class, 'org'])->middleware('permission:org')->name('organisations');
    Route::get('/reports',        [Reports::class,       'reports'])->middleware('permission:rep')->name('reports');

    // Student-specific routes
    Route::get('/my_opportunities', [Opportunity::class, 'soppo'])->middleware('permission:soppo')->name('my_opportunities');
    Route::get('/my_applications',  [Apps::class,        'sappo'])->middleware('permission:sappo')->name('my_applications');

    // AI Tools
    Route::get('/ai_assistant',      [Aitools::class, 'ass'])->middleware('permission:ait')->name('ai_assistant');
    Route::get('/ai_resume_checker', [Aitools::class, 'check'])->middleware('permission:air')->name('ai_resume_checker');

    // Settings (all require 'set' permission) 
    Route::middleware('permission:set')->group(function () {

        // Permission settings
        Route::get('/permission_settings',           [Settings::class, 'permit'])->name('permission_settings');
        Route::patch('/permission_settings/{id}',    [Settings::class, 'permitUpdate'])->name('permission_settings.update');

        // System logs
        Route::get('/system_logs',                   [Settings::class, 'logs'])->name('system_logs');
        Route::delete('/system_logs/clear',          [Settings::class, 'logsClear'])->name('system_logs.clear');

        // General settings
        Route::get('/general_settings',              [Settings::class, 'gen'])->name('general_settings');
        Route::patch('/general_settings',            [Settings::class, 'genUpdate'])->name('general_settings.update');
    });

});