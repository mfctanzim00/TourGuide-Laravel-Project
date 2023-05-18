<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\CommentNotification;
use Illuminate\Http\Request;
use Auth;

class CommentNotificationController extends Controller
{
    public function store(Request $request, $comment) {
        $current_comment = Comment::find($comment);

        $commentNotification = new CommentNotification();
        $commentNotification->comment_id = $comment;
        $commentNotification->post_id = $current_comment->post_id;
        $commentNotification->repliedUser_id = Auth::id();
        $commentNotification->comment_replied_to_id = $current_comment->user_id;
        $commentNotification->save();
    }
}
