<?php

namespace App\Http\Controllers\Dashboard\Blog\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;

class PostPublishController extends Controller
{
    public function update(Post $post)
    {
        $updatedPost = PostService::togglePublish($post);
        
        $responseMessage = $updatedPost->publish ?
        'O post <strong>'.$post->title.'</strong> foi publicado!' :
        'O post <strong>'.$post->title.'</strong> não está mais visível!';

        return $this->sendSuccessResponse([
            'type' => $post->publish ? 'success' : 'warning',
            'body' => $responseMessage,
        ]);
    }
}
