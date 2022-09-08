<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // same as params.permit in RoR; protects against mass assignment vulnerability
    // protected $fillable = ['title', 'excerpt', 'body'];
    //can use $guarded as well, which will only protect that field
    protected $guarded = [];


    public function category() {
        //Eloquent relationship
        return $this->belongsTo(Category::class);
    }

    public function user() {
        //Eloquent relationship
        return $this->belongsTo(User::class);
    }
}

//Post::create(['title' => 'My Hobby Post', 'excerpt' => 'Excerpt for hobby', 'body' => 'Body of hobby post', 'slug' => 'my-hobby-post', 'category_id' => 3]);
