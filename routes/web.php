<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;



//route, route method, '/path', [controllerName, controllerMethod],
Route::get('/', [PostController::class, 'index'])->name('home');

//take in Wildcard param from URI,
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest'); //guest = does not have to be authenticated to have access to this route
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');  //this route 'gets' the login view
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');  //this route 'posts' to the db a new session
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth'); //auth = they have to have completed auth process to have access to this route



