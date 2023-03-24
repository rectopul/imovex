<?php

namespace App\Http\Controllers\Dashboard\Blog\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostAtHomeController extends Controller
{
    public function update(Post $post)
    {
        
        $post->update([
            'at_home' => !$post->at_home
        ]);

        $message = 'será exibido na home!';

        if($post->at_home == false) {
            $message = 'foi removido da home!';
        }

        return $this->sendSuccessResponse([
            'type' => 'success',
            'body' => 'O post <strong>'.$post->title.'</strong> '.$message
        ]);
    }
}
