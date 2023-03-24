<?php

namespace App\Http\Controllers\Web\Search;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $posts = Post::published()
        ->search($request->search)
        ->limit(8)
        ->orderBy('publish', 'desc')
        ->get();

        return $posts;

    }
}
