<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function apiIndex(){
        $posts = Post::with('category', 'tags')->paginate(4);

        return response()->json($posts); 
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
}
