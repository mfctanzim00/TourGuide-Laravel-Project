<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts', [App\Http\Controllers\HomeController::class, 'posts'])->name('posts');
Route::get('/post/{slug}', [App\Http\Controllers\HomeController::class, 'post'])->name('post');
Route::get('/categories', [App\Http\Controllers\HomeController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [App\Http\Controllers\HomeController::class, 'categoryPost'])->name('category.post');
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/tag/{name}', [App\Http\Controllers\HomeController::class, 'tagPosts'])->name('tag.posts');


////    Admin   

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('profile', 'DashboardController@showProfile')->name('profile');
	Route::put('profile', 'DashboardController@updateProfile')->name('profile.update');
	Route::put('profile/password', 'DashboardController@changePassword')->name('profile.password');
	Route::resource('user', 'UserController')->except(['create', 'show', 'edit', 'store']);
	Route::resource('category', 'CategoryController')->except(['create', 'show', 'edit']);
	Route::resource('post', 'PostController');
});



////    User

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});





/////  View Composer
View::composer('layouts.frontend.partials.sidebar', function($view){
	$categories = Category::all()->take(10);
	$recentTags = Tag::all();
	$recentPosts = Post::latest()->take(3)->get();
	return $view->with('categories', $categories)->with('recentPosts', $recentPosts)->with('recentTags', $recentTags);
});
