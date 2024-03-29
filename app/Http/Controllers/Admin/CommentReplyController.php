<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommentReply;
use Brian2694\Toastr\Facades\Toastr;

class CommentReplyController extends Controller
{
    public function index() {
        $reply_comments = CommentReply::all();
        return view('admin.reply-comments.index', compact('reply_comments'));
    }

    public function destroy($id) {
        $reply_comment = CommentReply::find($id);
        $reply_comment->delete();
        Toastr::success('Comment successfully deleted.');
        return redirect()->back();
    }
}
