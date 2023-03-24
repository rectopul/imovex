<?php

namespace App\Http\Controllers\Dashboard\Blog\Comment;

use App\Http\Controllers\Controller;
use App\Models\PostComment;
use App\Services\PostCommentService;
use Illuminate\Http\Request;

class CommentModerateController extends Controller
{
    public function update(PostComment $comment, String $status)
    {
        return PostCommentService::moderate($comment, $status);
    }
}
