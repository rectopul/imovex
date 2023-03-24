<?php

namespace App\Http\Controllers\Web\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostCommentRequest;
use App\Services\PostCommentService;

class PostCommentController extends Controller
{
    public function store(PostCommentRequest $request)
    {
        return PostCommentService::create($request->validated());
    }
}
