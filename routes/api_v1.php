<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes (Version 0)
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for version 0 of your application.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Add more API v0 routes here
Route::get('hello', function () {
    return response()->json(['message' => 'Hello from API v0']);
});

Route::get('users', function () {
    return response()->json(\App\Models\User::all());
});
