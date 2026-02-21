<?php

use App\Http\Controllers\Alink;
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



Route::get('/', [Alink::class, 'index'])->name('login');
Route::get('/register', [Alink::class, 'register'])->name('register');


Route::get('/dashboard', [Dashboard::class, 'dash'])->name('dashboard');
Route::get('/profile', [Dashboard::class, 'profile'])->name('profile');


Route::get('/opportunities', [Opportunity::class, 'oppo'])->name('opportunities');
Route::get('/applications', [Apps::class, 'app'])->name('applications');
Route::get('/students', [Students::class, 'students'])->name('students');
Route::get('/notifications', [Notifications::class, 'notify'])->name('notifications');
Route::get('/organisations', [Organisations::class, 'org'])->name('organisations');
Route::get('/reports', [Reports::class, 'reports'])->name('reports'); 


Route::get('/permission_settings', [Settings::class, 'permit'])->name('permission_settings');
Route::get('/system_logs', [Settings::class, 'logs'])->name('system_logs');
Route::get('/general_settings', [Settings::class, 'gen'])->name('general_settings');

Route::get('/ai_assistant', [Aitools::class, 'ass'])->name('ai_assistant');
Route::get('/ai_resume_checker', [Aitools::class, 'check'])->name('ai_resume_checker');
