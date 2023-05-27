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
    public function store($mentionedUser, $comment, $message) {
        $currentUser = User::find(Auth::id());
        $currentComment = Comment::find($comment);

        // Split the message into an array of words
        $words = explode(" ", $message);
 
        // Check if the first character of the first word is @
        if (!empty($words[0]) && $words[0][0] === "@") {
        // Remove the @ character from the first word
            $words[0] = substr($words[0], 1);
        }
 
        // Remove the first word
        $removedFirstWord = array_slice($words, 1);
 
        // Convert the remaining words back into a string
        $message = implode(" ", $removedFirstWord);

        $commentNotification = new CommentNotification();
        $commentNotification->post_id = $currentComment->post_id;
        $commentNotification->repliedUser = $currentUser->name;
        $commentNotification->mentionedUser = $mentionedUser;
        $commentNotification->message = $message;
        $commentNotification->save();
    }

    public function index() {
        $currentUser = User::find(Auth::id());
        $notifications = CommentNotification::where('mentionedUser', $currentUser->name)->latest()->get();
        return view('user.comment-notification.index', compact('notifications'));
    }

    public function destroy($id) {
        $commentNotification = CommentNotification::find($id);
        $commentNotification->delete();
        return redirect()->back();
    }
}
