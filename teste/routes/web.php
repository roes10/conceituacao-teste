<?php

use App\Http\Controllers\Management\RoleController;
use App\Http\Controllers\Management\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', fn() => redirect()->route('login'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
