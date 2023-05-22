<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;
use App\Models\CommentReply;
use App\Models\CommentNotification;
use Illuminate\Http\Request;
use Auth;

class CommentNotificationController extends Controller
{
    public function store($mentionedUser, $comment) {
        $currentUser = User::find(Auth::id());
        $currentComment = Comment::find($comment);

        $commentNotification = new CommentNotification();
        $commentNotification->post_id = $currentComment->post_id;
        $commentNotification->repliedUser = $currentUser->name;
        $commentNotification->mentionedUser = $mentionedUser;
        $commentNotification->save();
    }

    public function index() {
        $currentUser = User::find(Auth::id());
        $notifications = CommentNotification::where('mentionedUser', $currentUser->name)->latest()->get();
        return view('user.comment-notification.index', compact('notifications'));
    }
}
