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
Route::get('/blog/refresh', [\App\Http\Controllers\BlogController::class, 'refresh']);
Route::get('/blog/add', [\App\Http\Controllers\BlogController::class, 'add']);
Route::post('/blog/add/process', [\App\Http\Controllers\BlogController::class, 'addProcess']);
Route::get('/blog/edit/{id}', [\App\Http\Controllers\BlogController::class, 'edit']);
Route::get('/blog/editData/{id}', [\App\Http\Controllers\BlogController::class, 'editData']);
Route::post('/blog/editDataProcess/{id}', [\App\Http\Controllers\BlogController::class, 'editDataProcess']);