<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;



//route, route method, '/path', [controllerName, controllerMethod], -> route name
Route::get('/', [PostController::class, 'index'])->name('home');

//take in Wildcard param from URI,
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create']);

Route::post('register', [RegisterController::class, 'store']);


