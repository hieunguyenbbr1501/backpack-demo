<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Alert;

class MainPageController extends Controller
{
    //
    public function show($slug){
        $post = Post::where('slug',$slug)->firstOrFail();
        if(!$post->publish){
            abort(404);
        }
        return view('main.post')->with(compact('post'));
    }
}
