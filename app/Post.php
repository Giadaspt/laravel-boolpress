<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
    
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    public static function makeSlug($title){
        $slug = Str::slug($title);
        $slug_base = $slug;

        $slug_exist = Post::where('slug', $slug)->first();

        $c = 1;
        while($slug_exist){
            $slug = $slug_base . '-' . $c;
            $c++;
            $slug_exist = Post::where('slug', $slug)->first();
        }
        return $slug;
    }

 
}
