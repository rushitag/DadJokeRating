<?php

use App\Http\Controllers\JokeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('get/joke/lists',[JokeController::class,'getJoke'])->name('get.joke');
Route::get('set/joke',[JokeController::class,'setJoke'])->name('set.joke');

Route::post('save/joke/rate',[JokeController::class,'saveJokeRate'])->name('save.joke');
