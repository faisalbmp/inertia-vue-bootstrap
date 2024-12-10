<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('roles', RoleController::class);
});

Route::middleware('auth')->get('/', function () {
    return inertia('Dashboard');
})->name('dashboard');