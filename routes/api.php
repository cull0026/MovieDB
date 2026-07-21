<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('movies', MovieController::class);

Route::apiResource('genres', GenreController::class)
    ->only(['index', 'show']);
