<?php

use App\Http\Controllers\Alink;
use App\Http\Controllers\dash\Dashboard;
use App\Http\Controllers\dash\Opportunity;
use Illuminate\Support\Facades\Route;



Route::get('/', [Alink::class, 'index'])->name('login');
Route::get('/register', [Alink::class, 'register'])->name('register');
Route::get('/dashboard', [Dashboard::class, 'dash'])->name('dashboard');
Route::get('/profile', [Dashboard::class, 'profile'])->name('profile');
Route::get('/opportunities', [Opportunity::class, 'oppo'])->name('opportunities');