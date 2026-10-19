<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store'])->middleware('throttle:30,1');
Route::get('/status', StatusController::class);
