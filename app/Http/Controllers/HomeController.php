<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

use Auth;
use Illuminate\Support\Facades\Session;

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
        $hotPosts = Post::where('status', 1)->orderBy('view_count', 'desc')->get();
        return view('index', compact('posts', 'hotPosts'));
    }

    public function posts()
    {
        $posts = Post::latest()->where('status', 1)->paginate(2);
        return view('posts', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->first();
     //   $posts = Post::latest()->take(3)->where('status', 1)->get();

        // Increase viewCount
        $postKey = 'post_'.$post->id;
        if(!Session::has($postKey)) {
            $post->increment('view_count');
            Session::put($postKey, 1);
        }
        return view('post', compact('post'));
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
        return view('categoryPost', compact('posts', 'category'));
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
        $query = $name;
        $tags = Tag::where('name', 'like', "%$name%")->paginate(4);
        $tags->appends(['search' => $name ]);

        return view('tagPosts', compact('tags', 'query'));
    }

    public function likePost($post) 
    {
        // Check if user already liked the post or not
        $user = Auth::user();
        $likePost = $user->likedPosts()->where('post_id', $post)->count();

        if($likePost == 0) {
            $user->likedPosts()->attach($post);
        }
        else {
            $user->likedPosts()->detach($post);
        }
        return redirect()->back();
    }
}
