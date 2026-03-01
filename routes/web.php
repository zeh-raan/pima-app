<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

// API
Route::apiResource('projects', ProjectController::class);
Route::apiResource('tasks', TaskController::class);

// Project
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}/tasks', [TaskController::class, 'index']);

// Task
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
