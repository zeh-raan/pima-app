<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

// API routes protected behind API Key auth
Route::middleware('api_key')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class);
});