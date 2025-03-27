<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImcController;
use App\Http\Controllers\SleepController;
use App\Http\Controllers\TravelController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/imc', [ImcController::class, 'show'])->name('imc.show');
Route::post('/imc/calculate', [ImcController::class, 'calculate'])->name('imc.calculate');

Route::get('/sleep', [SleepController::class, 'show'])->name('sleep.show');
Route::post('/sleep/evaluate', [SleepController::class, 'evaluate'])->name('sleep.evaluate');

Route::get('/travel', [TravelController::class, 'show'])->name('travel.show');
Route::post('/travel/calculate', [TravelController::class, 'calculate'])->name('travel.calculate');