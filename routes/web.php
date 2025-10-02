<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Livewire\SearchJobs;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index'])
    ->name('jobs.index');

Route::get('/jobs/create', [JobController::class, 'create'])
    ->middleware('auth');

Route::post('/jobs', [JobController::class, 'store'])
    ->middleware('auth');

Route::get('/jobs/search', SearchJobs::class)
    ->name('jobs.search');

Route::get('/jobs/{job}', [JobController::class, 'show'])
    ->name('jobs.show');


Route::middleware('auth')->group(function() {
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
        ->can('edit', 'job')
        ->name('jobs.edit');

    Route::patch('/jobs/{job}', [JobController::class, 'update'])
        ->name('jobs.update')
        ->can('edit', 'job');

    Route::delete('/jobs/{job}/destroy', [JobController::class, 'destroy'])
        ->name('jobs.destroy')
        ->can('edit', 'job');
});

Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/employers', [EmployerController::class, 'index'])->name('employers.index');

Route::middleware('auth')->group(function() {
    Route::get('/employers/{employer}/edit', [EmployerController::class, 'edit'])
        ->can('edit', 'employer')
        ->name('employers.edit');
    Route::patch('/employers/{employer}', [EmployerController::class, 'update'])
        ->can('edit', 'employer')
        ->name('employers.update');
});
