<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

// Routes that require authentication =====================================================================

Route::middleware('auth')->group(function () {
    // Job creation and management
    Route::get('/jobs/create', [JobController::class, 'create']);

    Route::post('/jobs', [JobController::class, 'store']);

    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
        ->can('edit', 'job')
        ->name('jobs.edit');

    Route::patch('/jobs/{job}', [JobController::class, 'update'])
        ->can('edit', 'job')
        ->name('jobs.update');

    Route::delete('/jobs/{job}/destroy', [JobController::class, 'destroy'])
        ->can('edit', 'job')
        ->name('jobs.destroy');

    // Employer management
    Route::get('/employers/{employer}/edit', [EmployerController::class, 'edit'])
        ->can('edit', 'employer')
        ->name('employers.edit');

    Route::patch('/employers/{employer}', [EmployerController::class, 'update'])
        ->can('edit', 'employer')
        ->name('employers.update');

    // Logout
    Route::delete('/logout', [SessionController::class, 'destroy']);
});

// Routes that require the user to be a guest (not authenticated) ===============================================

Route::middleware('guest')->group(function () {
    // Registration management
    Route::get('/register', [RegisteredUserController::class, 'create']);

    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Login management
    Route::get('/login', [SessionController::class, 'create'])->name('login');

    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
});

// Routes that do not require authentication ==============================================================

Route::get('/', [JobController::class, 'index'])->name('jobs.index');

Route::view('/jobs/search', 'jobs.search', ['facetMethod' => 'query']) // query or all
->name('jobs.search');

Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/employers', [EmployerController::class, 'index'])->name('employers.index');



