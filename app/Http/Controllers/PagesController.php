<?php

namespace App\Http\Controllers;

use App\Enums\PostType;
use App\Models\Post;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages/home');
    }

    public function aboutUs()
    {
        return view('pages/about-us');
    }

    public function pro()
    {
        return view('pages/pro');
    }

    public function blog()
    {
        $posts = Post::where('type', '!=', PostType::Documents)->paginate(9);

        return view('pages/blog')->with('posts', $posts);
    }

    public function singleBlog($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('pages/blog-single')->with('post', $post);
    }
}
