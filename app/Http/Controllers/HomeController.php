<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->take(6)->where('status', 1)->get();
        return view('index', compact('posts'));
    }

    public function posts()
    {
        $posts = Post::latest()->where('status', 1)->paginate(2);
        return view('posts', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->first();
        $posts = Post::latest()->take(3)->where('status', 1)->get();
        return view('post', compact('post', 'posts'));
    }

    public function categories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function categoryPost($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->where('status', 1)->paginate(10);
        return view('categoryPost', compact('posts'));
    }

    public function search(Request $request)
    {
        $this->validate($request, ['search' => 'required|max:255' ]);
        $search = $request->search;
        $posts = Post::where('title', 'like', "%$search%")->paginate(10);
        $posts->appends(['search' => $search ]);
        return view('search', compact('posts', 'search'));
    }

    public function tagPosts($name)
    {
        $tags = Tag::where('name', 'like', "%$name%")->get();
    }
}
