<?php

use Illuminate\Support\Facades\Route;

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

// Documentation on how to use the API
Route::get('/docs', function() { 
    return view('docs'); 
})->middleware('auth'); // Protected behind user auth

// Project and task pages
use App\Http\Controllers\ProjectController;
Route::get('/projects/{id}', [ProjectController::class, 'webShow'])->middleware('auth');

/*
// Project
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}/tasks', [TaskController::class, 'index']);

// Task
Route::get('/tasks', [TaskController::class, 'index']); // For testing

Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
*/