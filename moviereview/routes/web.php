<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [MovieController::class, 'index'])->name('home');

Auth::routes();

Route::resource('movies', MovieController::class);
Route::resource('reviews', ReviewController::class)->except(['show', 'edit', 'update']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');