<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::apiResource('movies', MovieController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::apiResource('genres', GenreController::class)
    ->only(['index', 'show']);
