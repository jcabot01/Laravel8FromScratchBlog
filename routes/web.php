<?php

use App\Http\Controllers\PostController;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//route, route method, '/path', [controllerName, controllerMethod], -> route name
Route::get('/', [PostController::class, 'index'])->name('home');

//take in Wildcard param from URI,
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [ //load a view; the posts.php
        'posts' => $category->posts,  //variables derived from associations, passed to view
        'currentCategory' => $category,
        "categories" => Category::all()
    ]);
})->name('category');

//'authors/{author}'  would give us Id, below gives us username param
Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [ //load a view; the posts.php
        'posts' => $author->posts,
        "categories" => Category::all()
    ]);
});
