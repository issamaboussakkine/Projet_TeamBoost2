<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/checkin', [CheckInController::class, 'index'])->name('checkin.index');
    Route::post('/checkin', [CheckInController::class, 'store'])->name('checkin.store');
    Route::get('/team-wall', [CheckInController::class, 'teamWall'])->name('team-wall');
    
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::delete('/checkin/{id}', [App\Http\Controllers\AdminController::class, 'deleteCheckIn'])->name('admin.delete.checkin');
        Route::post('/make-admin/{id}', [App\Http\Controllers\AdminController::class, 'makeAdmin'])->name('admin.make.admin');
        Route::post('/make-employee/{id}', [App\Http\Controllers\AdminController::class, 'makeEmployee'])->name('admin.make.employee');
    });
});

require __DIR__.'/auth.php';