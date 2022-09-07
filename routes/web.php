<?php

use App\Models\Post;
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
    return view('posts', [
        "posts" => Post::all() //fetch all files in Posts directory
    ]);
});

//using a Wildcard parameter in the URI
Route::get('posts/{post}', function ($slug) { //fetch slug 'my-first-post"
    //Find a post by its slug, and pass it to a view called 'post'
    return view('post', [ //return 'post'; 'post' equals the Post class and findOrFail method, with the passed in parameter
        'post' => Post::findOrFail($slug)
    ]);
});
