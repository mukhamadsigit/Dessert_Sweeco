<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

$namespace = 'App\Http\Controllers\Api';

// Authentication Routes
Route::post('/register', $namespace . '\AuthController@register');
Route::post('/login', $namespace . '\AuthController@login');

// Protected Routes (Sanctum)
Route::middleware('auth:sanctum')->group(function () use ($namespace) {
    // User / Profile
    Route::get('/user', $namespace . '\ProfileController@show');
    Route::put('/user', $namespace . '\ProfileController@update');
    Route::post('/logout', $namespace . '\AuthController@logout');
    
    // Orders
    Route::get('/orders', $namespace . '\OrderController@index');
    Route::get('/orders/{id}', $namespace . '\OrderController@show');
    Route::post('/orders', $namespace . '\OrderController@store');
});

// Public Routes
Route::get('/menus', $namespace . '\MenuController@index');
Route::get('/menus/{id}', $namespace . '\MenuController@show');