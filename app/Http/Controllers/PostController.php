<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::active(1)
            ->with(['author', 'category', 'comments', 'poster'])
            ->whenCategory($request)
            ->whenSearch($request)
            ->orderBy('id', 'desc')
            ->paginate(15);

            $categories = PostCategory::has('posts')->get();

            $main_post = Post::active(1)
            ->with(['author', 'category', 'comments'])
            ->first();

        return view('pages.posts.index', [
            'posts' => $posts,
            'main_post' => $main_post,
            'categories' => $categories
        ]);


    } //-- end index

    public function show(Post $post){
        //dd(auth()->user()->profile_photo_url);

        return view('pages.posts.show', [
           'post' => $post
        ]);
    }//-- end show
}//-- end of class PostController
