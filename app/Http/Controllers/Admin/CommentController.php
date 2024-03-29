<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentReply;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function index() {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy($id) {
        $comment = Comment::find($id);
        $replies = CommentReply::where('comment_id', $id)->delete();
        $comment->delete();
        Toastr::success('Comment successfully deleted.');
        return redirect()->back();
    }
}
