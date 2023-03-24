<?php

namespace App\Http\Controllers\Dashboard\Blog\Comment;

use App\Http\Controllers\Controller;
use App\Models\PostComment;
use App\Services\PostCommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return PostCommentService::dataTable();
        }

        return view('dashboard.blog.comment.index');
    }

    public function destroy(PostComment $comment)
    {
        PostCommentService::delete($comment);

        return $this->sendSuccessResponse([
            'reloadDatatable' => 'comment-table',
            'message' => 'O comentário foi excluído!'
        ]);
    }
}
