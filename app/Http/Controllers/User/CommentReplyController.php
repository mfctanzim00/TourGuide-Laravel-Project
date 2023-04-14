<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommentReply;
use Auth;

class CommentReplyController extends Controller
{
    public function index() {
        $reply_comments = CommentReply::where('user_id', Auth::id())->get();
        return view('user.reply-comments.index', compact('reply_comments'));
    }

    public function destroy($id) {
        $reply_comment = CommentReply::find($id);

        if ($reply_comment->user_id == Auth::id()) {
            $reply_comment->delete();
            Toastr::success('Comment successfully deleted.');
        }
        else {
            $reply_comment->delete();
            Toastr::error('You cannot delete this comment');
        }
        return redirect()->back();
    }
}
