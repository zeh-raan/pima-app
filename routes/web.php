<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

// User routes
use App\Http\Controllers\AuthController;
Route::get('/signup', function() {
    return view('signup');
})->name('signup');

Route::get('/login', function() {
    return view('login');
})->name('login');

// Handle forms
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Protected home
Route::get('/', function () {
    return view('home');
})->middleware('auth');

// Route to generate API Key
use App\Http\Controllers\APIKeyController;
Route::post(
    '/generate-key', [APIKeyController::class, 'generate']
)->middleware('auth')->name('generate.key');

// TODO: Move these routes in /routes/api.php
// API routes authed with API Key
Route::middleware('api_key')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class);
});

/*
// Project
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}/tasks', [TaskController::class, 'index']);

// Task
Route::get('/tasks', [TaskController::class, 'index']); // For testing

Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
*/