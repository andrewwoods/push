<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'home']);

Route::post('/url/create', [UrlController::class, 'create']);

Route::get('/url/clean', [UrlController::class, 'cleanForm']);
Route::post('/url/clean', [UrlController::class, 'clean']);

Route::get('/token', [MainController::class, 'token']);
Route::get('/phpinfo', [MainController::class, 'phpinfo']);
Route::get('/url/{id}', [UrlController::class, 'show']);
Route::get('/{id}', [UrlController::class, 'redirect']);
