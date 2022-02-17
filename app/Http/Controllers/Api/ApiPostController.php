<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function apiIndex(){
        $posts = Post::with('category', 'tags')->paginate(4);
        $categories = Category::all();
        $tags = Tag::all();

        return response()->json(compact('posts', 'categories', 'tags')); 
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();
        
        if(!$post){
            $post = [
                'title' => 'Nessuna pagina trovata',
                'content' => ''
            ];
        }

        return response()->json($post);
    }

    public function getCategoryPost($slug_category){
        $category = Category::where('slug', $slug_category)->with('posts.tags')->first();
        $success = true;
        $error = "";

        if(!$category){
            $success = false;
            $error = 'Categoria inesistente';
        } elseif($category && count($category['posts']) === 0){
            $success = false;
            $error= "non esistono post per questa categoria";
        }

        return response()->json(compact('success', 'category', 'error'));
    }
 
    public function getTagPost($slug_tag){
        $tag = Tag::where('slug', $slug_tag)->with('posts.category')->first();
        $success = true;
        $error = "";

        if(!$tag){
            $success = false;
            $error = 'Tag inesistente';
        } elseif($tag && count($tag['posts']) === 0){
            $success = false;
            $error= "non esistono post per questo tag";
        }

        return response()->json(compact('success', 'tag', 'error'));
    }
 
}
