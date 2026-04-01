<?php

use App\Http\Controllers\Alink;
use App\Http\Controllers\Home;
use App\Http\Controllers\AboutUs;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\dash\Dashboard;
use App\Http\Controllers\dash\ProfileController;
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
    Route::get('/login', [Alink::class, 'index'])->name('login');
    Route::post('/login', [Alink::class, 'login'])->name('login.post');
    Route::get('/register', [Alink::class, 'register'])->name('register');
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
    Route::post('/update_profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/update_password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Core sections
    Route::get('/opportunities', [Opportunity::class, 'oppo'])->middleware('permission:oppo')->name('opportunities');
    Route::get('/opportunities/create', [Opportunity::class, 'create'])->middleware('permission:aoppo')->name('oppo.create');
    Route::post('/opportunities/store', [Opportunity::class, 'store'])->middleware('permission:aoppo')->name('oppo.store');
    Route::get('/opportunities/{oppo}/edit', [Opportunity::class, 'edit'])->middleware('permission:eoppo')->name('oppo.edit');
    Route::put('/opportunities/{oppo}', [Opportunity::class, 'update'])->middleware('permission:eoppo')->name('oppo.update');
    Route::delete('/opportunities/{oppo}', [Opportunity::class, 'destroy'])->middleware('permission:eoppo')->name('oppo.destroy');

    Route::get('/applications', [Apps::class, 'app'])->middleware('permission:app')->name('applications');

    Route::get('/students', [Students::class, 'students'])->middleware('permission:stud')->name('students');
    Route::post('/students', [Students::class, 'store'])->middleware('permission:astud')->name('students.store');
    Route::patch('/students/{student}', [Students::class, 'update'])->middleware('permission:estud')->name('students.update');
    Route::delete('/students/{student}', [Students::class, 'destroy'])->middleware('permission:estud')->name('students.destroy');


    Route::get('/notifications', [Notifications::class, 'notify'])->middleware('permission:not')->name('notifications');
    Route::post('/notifications/{notification}/read', [Notifications::class, 'markRead'])->middleware('permission:not')->name('notifications.markRead');
    Route::post('/notifications/read-all', [Notifications::class, 'markAllRead'])->middleware('permission:not')->name('notifications.markAllRead');
    Route::delete('/notifications/{notification}', [Notifications::class, 'destroy'])->middleware('permission:not')->name('notifications.destroy');
    Route::post('/notifications/preferences', [Notifications::class, 'savePreferences'])->middleware('auth')->name('notifications.preferences');

    Route::get('/organisations', [Organisations::class, 'org'])->middleware('permission:org')->name('organisations');
    Route::post('/organisations', [Organisations::class, 'store'])->middleware('permission:aorg')->name('organisations.store');
    Route::patch('/organisations/{organisation}', [Organisations::class, 'update'])->middleware('permission:eorg')->name('organisations.update');
    Route::delete('/organisations/{organisation}', [Organisations::class, 'destroy'])->middleware('permission:eorg')->name('organisations.destroy');

    // Reports and exports
    Route::get('/reports', [Reports::class, 'reports'])->middleware('permission:rep')->name('reports');
    Route::get('/reports/students/pdf', [Reports::class, 'downloadStudents'])->middleware('permission:rep')->name('reports.students.pdf');
    Route::get('/reports/orgs/pdf', [Reports::class, 'downloadOrgs'])->middleware('permission:rep')->name('reports.orgs.pdf');
    Route::get('/reports/applications/pdf', [Reports::class, 'downloadApplications'])->middleware('permission:rep')->name('reports.applications.pdf');
    Route::get('/reports/ai/pdf', [Reports::class, 'downloadAiUsage'])->middleware('permission:rep')->name('reports.ai.pdf');

    // Student-specific routes
    Route::get('/my_opportunities', [Opportunity::class, 'soppo'])->middleware('permission:soppo')->name('my_opportunities');
    Route::get('/my_applications', [Apps::class, 'sappo'])->middleware('permission:sappo')->name('my_applications');

    // Application modal routes (student)
    Route::get('/opportunities/{oppo}/apply-data', [Apps::class, 'show'])->middleware('permission:soppo')->name('oppo.apply.data');
    Route::post('/opportunities/{oppo}/apply', [Apps::class, 'store'])->middleware('permission:soppo')->name('oppo.apply.store');

    // Applicants modal + status update (company/admin)
    Route::get('/opportunities/{oppo}/applicants', [Apps::class, 'applicants'])->middleware('permission:app')->name('oppo.applicants');
    Route::patch('/applications/{application}/status', [Apps::class, 'updateStatus'])->middleware('permission:app')->name('application.status');

    // AI Tools
    Route::get('/ai_assistant', [Aitools::class, 'ass'])->middleware('permission:ait')->name('ai_assistant');
    Route::get('/ai_assistant/history', [Aitools::class, 'assHistory'])->middleware('permission:ait')->name('ai.assistant.history');
    Route::delete('/ai_assistant/history', [Aitools::class, 'assClearHistory'])->middleware('permission:ait')->name('ai.assistant.history.clear');
    Route::post('/ai_assistant/chat', [Aitools::class, 'assChat'])->middleware('permission:ait')->name('ai.assistant.chat');
    Route::get('/ai_resume_checker', [Aitools::class, 'check'])->middleware('permission:air')->name('ai_resume_checker');
    Route::post('/ai_resume_checker/check', [Aitools::class, 'checkResume'])->middleware('permission:air')->name('ai.resume.check');
    Route::get('/ai_analytics', [Aitools::class, 'analytics'])->middleware('permission:aia')->name('ai_analytics');
    Route::post('/ai_analytics/insight', [Aitools::class, 'analyticsInsight'])->middleware('permission:aia')->name('ai.analytics.insight');

    // Settings (all require 'set' permission)
    Route::middleware('permission:set')->group(function () {
        Route::get('/permission_settings', [Settings::class, 'permit'])->name('permission_settings');
        Route::patch('/permission_settings/{id}', [Settings::class, 'permitUpdate'])->name('permission_settings.update');
        Route::get('/system_logs', [Settings::class, 'logs'])->name('system_logs');
        Route::delete('/system_logs/clear', [Settings::class, 'logsClear'])->name('system_logs.clear');
        Route::get('/general_settings', [Settings::class, 'gen'])->name('general_settings');
        Route::patch('/general_settings', [Settings::class, 'genUpdate'])->name('general_settings.update');
    });

});