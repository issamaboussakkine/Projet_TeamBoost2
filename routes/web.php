<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckInController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes pour le module Check-in
    Route::get('/checkin', [CheckInController::class, 'index'])->name('checkin.index');
    Route::post('/checkin', [CheckInController::class, 'store'])->name('checkin.store');
    Route::get('/team-wall', [CheckInController::class, 'teamWall'])->name('team-wall');
});

require __DIR__.'/auth.php';