<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ImageGenerationController;

Route::post('register-test', [RegisteredUserController::class, 'store']);

Route::post('login-test', [LoginController::class, 'store'])
->middleware('throttle:login')
;

Route::middleware('auth:api','throttle:posts')->group(function () {

    Route::post('/logout-test', [LoginController::class, 'destroy']);
    Route::post('/refresh', [LoginController::class, 'refresh']);
    Route::get('/me', [LoginController::class, 'me']);
    Route::apiResource('posts',PostController::class);
});