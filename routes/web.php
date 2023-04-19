<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Mail\NewPost;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/users', function () {
    return view('admin.users.index');
});

Auth::routes();


// Social Login
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts', [App\Http\Controllers\HomeController::class, 'posts'])->name('posts');
Route::get('/post/{slug}', [App\Http\Controllers\HomeController::class, 'post'])->name('post');
Route::get('/categories', [App\Http\Controllers\HomeController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [App\Http\Controllers\HomeController::class, 'categoryPost'])->name('category.post');
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/tag/{name}', [App\Http\Controllers\HomeController::class, 'tagPosts'])->name('tag.posts');
Route::post('/comment/{post}', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store')->middleware('auth');
Route::post('/comment-reply/{comment}', [App\Http\Controllers\CommentReplyController::class, 'store'])->name('reply.store')->middleware('auth');
Route::post('/like-post/{post}', [App\Http\Controllers\HomeController::class, 'likePost'])->name('post.like')->middleware('auth');


////    Admin   

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('profile', 'DashboardController@showProfile')->name('profile');
	Route::put('profile', 'DashboardController@updateProfile')->name('profile.update');
	Route::put('profile/password', 'DashboardController@changePassword')->name('profile.password');
	Route::resource('user', 'UserController')->except(['create', 'show', 'edit', 'store']);
	Route::resource('category', 'CategoryController')->except(['create', 'show', 'edit']);
	Route::resource('post', 'PostController');
	Route::get('/comments', 'CommentController@index')->name('comment.index');
	Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
	Route::get('/reply-comments', 'CommentReplyController@index')->name('reply-comment.index');
	Route::delete('/reply-comment/{id}', 'CommentReplyController@destroy')->name('reply-comment.destroy');
	Route::get('/post-liked-users/{post}', 'PostController@likedUsers')->name('post.like.users');
});



////    User

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('profile', 'DashboardController@showProfile')->name('profile');
	Route::put('profile', 'DashboardController@updateProfile')->name('profile.update');
	Route::put('profile/password', 'DashboardController@changePassword')->name('profile.password');
	Route::get('comments', 'CommentController@index')->name('comment.index');
	Route::delete('comment/{id}', 'CommentController@destroy')->name('comment.destroy');
	Route::get('/reply-comments', 'CommentReplyController@index')->name('reply-comment.index');
	Route::delete('/reply-comment/{id}', 'CommentReplyController@destroy')->name('reply-comment.destroy');
	Route::get('/user-liked-posts', 'DashboardController@likedPosts')->name('like.posts');
});





/////  View Composer
View::composer('layouts.frontend.partials.sidebar', function($view){
	$categories = Category::all()->take(10);
	$recentTags = Tag::all();
	$recentPosts = Post::latest()->take(3)->get();
	return $view->with('categories', $categories)->with('recentPosts', $recentPosts)->with('recentTags', $recentTags);
});



// Send mail
Route::get('/send', function(){
	//return "Send Mail";
	$post = Post::find(7);
	// Send Mail
	Mail::to('user@user.com')
		->cc(['user1@user.com', 'user2@user.com'])
		->queue( new NewPost($post));
		
	return (new App\Mail\NewPost($post))->render();
});