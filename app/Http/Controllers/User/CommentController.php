<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentReply;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class CommentController extends Controller
{
    public function index() {
        $comments = Comment::where('user_id', Auth::id())->latest()->get();
        return view('user.comments.index', compact('comments'));
    }

    public function destroy($id) {
        $comment = Comment::find($id);
        if ($comment->user_id == Auth::id()) {
            $replies = CommentReply::where('comment_id', $id)->delete();
            $comment->delete();
            Toastr::success('Comment successfully deleted.');
        }
        else {
            $comment->delete();
            Toastr::error('You cannot delete this comment');
        }
        return redirect()->back();
    }
}
