<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\CommentNotification;
use App\Http\Controllers\CommentNotificationController;
use Brian2694\Toastr\Facades\Toastr;

use Auth;

class CommentReplyController extends Controller
{
    public function store(Request $request, $comment) { 
        $sentence = $request->message;
        $word = explode(" ",$sentence); // this will output an array of words
        $mentionedUser = substr($word[0], 1);
   // print_r($store);
   // dd(substr($store[0], 1));
      //  dd($comment);
       // dd($comment->name);
        $this->validate($request, ['message' => 'required|max:1000']);
        $commentReply = new CommentReply();
        $commentReply->comment_id = $comment;
        $commentReply->user_id = Auth::id();
        $commentReply->message = $request->message;
        $commentReply->save();

        $commentNotificationController = new CommentNotificationController();
        $commentNotificationController->store($mentionedUser, $comment, $request->message);

        Toastr::success('success', 'The comment replied successfully!');
        
        return redirect()->back();
    }
}
