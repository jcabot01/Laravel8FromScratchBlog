<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() {
        return cache()->rememberForever('posts.all', function() {
            return collect(File::files(resource_path("posts"))) //known as a 'collection'
            ->map(function ($file) { //most methods; filter, each, etc. can be used in a collection.
                $document = YamlFrontMatter::parseFile($file); //$document is assigned this parsed data

                return new Post( //push each attribute into $posts array
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            })
            ->sortByDesc('date');
        });
    }


    public static function find($slug) {
        return static::all()->firstWhere('slug', $slug);
    }

}
