<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::get('/compare', [\App\Http\Controllers\CharacterCompareController::class, 'index'])->name('compare.index');
    Route::post('/compare', [\App\Http\Controllers\CharacterCompareController::class, 'compare'])->name('compare.process');

    Route::resource('transactions', \App\Http\Controllers\TransactionController::class);
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
