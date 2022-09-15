<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;



//route, route method, '/path', [controllerName, controllerMethod],
Route::get('/', [PostController::class, 'index'])->name('home');

//take in Wildcard param from URI,
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest'); //logic that runs when a request comes in

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');



