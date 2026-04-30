<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;

Route::get('/', [MovieController::class, 'index']);
Route::get('/watchlist', [MovieController::class, 'watchlist'])->name('watchlist.index');