<?php

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

Route::get('/', function () {
    return view('posts', [          //with method prevents lazyLoad N+1 problem.  One query for all, rather than a query for each instance
        //"posts" => Post::latest()->with('category', 'author')->get() //fetch all files in Posts directory, latest post at the top
        "posts" => Post::latest()->get(), //move 'with' into Post model to always append category and author to Post object.  Known as 'eager loading'
        "categories" => Category::all() //set "categories" as key, containing all instances of categories.  Categories is now $categories in the posts view
    ]); //posts is a collection of posts
});

//take in Wildcard param from URI,
Route::get('posts/{post:slug}', function (Post $post) {//thanks to Eloquent, {post} & $post are binded in the Post model
    return view('post', [ //load a view; the post.php file
        'post' => $post //send $post instance
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [ //load a view; the posts.php
        'posts' => $category->posts
    ]);
});

//'authors/{author}'  would give us Id, below gives us username param
Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [ //load a view; the posts.php
        'posts' => $author->posts
    ]);
});
