<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

use Auth;

class DashboardController extends Controller
{
    public function index(){
    	$posts = Post::where('user_id', Auth::id())->get();
        $comments = Comment::where('user_id', Auth::id())->latest()->get();
        $users = User::all();
        $categories = Category::all();
   	    return view('user.index', compact('posts','comments','users','categories'));
    }

    public function likedPosts() {
        return view('user.likedPosts');
    }

    public function showProfile(){
        $user = User::find(Auth::user()->id);
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:users',
            'userid' => 'required',
            'about' => 'sometimes|max:255', 
            'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg|max:2000'
        ]);

        $user = User::findorFail(Auth::user()->id);

        if($request->image != NULL){
            // Image
            $image = $request->image;
            $imageName = Str::slug($request->name, '-'). uniqid(). '.'. $image->getClientOriginalExtension();
 
            if(!Storage::disk('public')->exists('user')){
                Storage::disk('public')->makeDirectory('user');
            }
            // Delete old image
            if($user->image!='default.jpg' && Storage::disk('public')->exists('user/'. $user->image)){
                Storage::disk('public')->delete('user/'. $user->image);
            }
            // store
            // $image->storeAs('user', $imageName, 'public');
            $userImg = Image::make($image)->fit(200, 200)->stream();
            // Store in public/user
            Storage::disk('public')->put('user/'.$imageName, $userImg);
        }
        else {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->userid = $request->userid;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();

        Toastr::success('Details Successfully Saved.', 'success');
        return redirect()->back();
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|max:255|confirmed'
        ]);

        $oldPass = Auth::user()->password;
        if(Hash::check($request->old_password, $oldPass)){
            if(!Hash::check($request->password, $oldPass)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                // Log out
                Auth::logout();
                return redirect()->back();
            }
            else {
                Toastr::error('New Password should not be the same as old password');
                return redirect()->back();
            }
        }
        else{
            Toastr::error('Enter the correct old password.');
            return redirect()->back();
        }
    }
}
