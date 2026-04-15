<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KudoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Kudos routes
Route::middleware('auth')->group(function () {
    Route::get('/kudos', [KudoController::class, 'index'])->name('kudos.index');
    Route::post('/kudos', [KudoController::class, 'store'])->name('kudos.store');
    Route::get('/leaderboard', [KudoController::class, 'leaderboard'])->name('kudos.leaderboard');
    Route::get('/my-kudos', [KudoController::class, 'myKudos'])->name('kudos.my-kudos');
});

require __DIR__.'/auth.php';