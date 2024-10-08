<?php

use App\Http\Controllers\JokeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JokeController::class, 'getJoke'])->name('get.joke');
Route::get('set/joke', [JokeController::class, 'setJoke'])->name('set.joke');

Route::post('save/joke/rate', [JokeController::class, 'saveJokeRate'])->name('save.joke');
