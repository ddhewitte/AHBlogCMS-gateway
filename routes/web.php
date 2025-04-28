<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

//Blog routing
Route::get('/', [\App\Http\Controllers\BlogController::class, 'index']);
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'refresh']);