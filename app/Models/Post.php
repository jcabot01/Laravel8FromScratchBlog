<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; //Post::factory() but no Post factories exist

    // same as params.permit in RoR; protects against mass assignment vulnerability
    // protected $fillable = ['title', 'excerpt', 'body'];
    //can use $guarded as well, which will only protect that field
    protected $guarded = [];

    protected $with = ['category', 'author'];  //always append category and author data to post object
    //known as 'eager loading' by default

    public function scopeFilter($query, array $filters)  //Post::newQuery()->filter()
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );


        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn ($query) => //give me the posts that have the category slug that matches the input
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn ($query) =>
                $query->where('username', $author)
            )
        );

    }


    public function category()
    {
        //Eloquent relationship
        return $this->belongsTo(Category::class);
    }


    public function author()
    {
        //Eloquent relationship
        return $this->belongsTo(User::class, 'user_id'); //reference user_id from DB
    }
}

//Post::create(['title' => 'My Hobby Post', 'excerpt' => 'Excerpt for hobby', 'body' => 'Body of hobby post', 'slug' => 'my-hobby-post', 'category_id' => 3]);
