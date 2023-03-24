<?php

namespace App\Http\Controllers\Dashboard\Blog\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostHighlightController extends Controller
{
    public function update(Post $post)
    {
        Post::where('highlight', true)->update(['highlight' => false]);

        $post->highlight = true;

        $post->save();

        return $this->sendSuccessResponse([
            'type' => 'success',
            'body' => 'O post <strong>'.$post->title.'</strong> foi marcado como destaque!'
        ]);

    }
}
