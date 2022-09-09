<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [          //with method prevents lazyLoad N+1 problem.  One query for all, rather than a query for each instance
            "posts" => Post::latest()->filter(request(['search']))->get(),
            "categories" => Category::all() //set "categories" as key, containing all instances of categories.  Categories is now $categories in the posts view
        ]); //posts is a collection of posts
    }



    public function show(Post $post)  //accept the $post in question as an argument
    {
        return view('post', [ //load a view; the post.php file
            'post' => $post //send post variable, containing $post instance
        ]);
    }
}
