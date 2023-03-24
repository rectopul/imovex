<?php

namespace App\Http\Controllers\Dashboard\Blog\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blog\Post\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return PostService::dataTable();
        }

        return view('dashboard.blog.post.index');
    }

    public function create() 
    {
        return view('dashboard.blog.post.create');
    }

    public function store(PostRequest $request)
    {
        $post = PostService::create($request->all());

        return $this->sendAlertSuccessResponse(
            'Post <strong>'.$post->title.'</strong> criado!', [
                'redirect' => route('dashboard.blog.post.index')
            ]
        );
    }

    public function edit(Post $post)
    {
        return view('dashboard.blog.post.create', [
            'post' => $post->load('categories')
        ]);
    }

    public function update(PostRequest $request, Post $post) 
    {
        $post = PostService::update($post, $request->all());

        return $this->sendAlertSuccessResponse(
            'Post <strong>'.$post->title.'</strong> atualizado!', [
                'redirect' => route('dashboard.blog.post.index')
            ]
        );

    }

    public function destroy(Post $post)
    {
        $clone = PostService::delete($post);

        return $this->sendSuccessResponse([
            'reloadDatatable' => 'post-table',
            'message' => 'O post <strong>'.$clone->title.'</strong> foi removido!'
        ]);
    }
}
