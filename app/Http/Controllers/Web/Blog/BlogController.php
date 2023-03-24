<?php

namespace App\Http\Controllers\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        return view('web.blog.index',[
            'highlightPost' => Post::where('highlight', true)->first(),
            'mostReadPosts' => Post::mostRead()->take(4)->get(),
            'mostReadCategories' => PostCategory::mostRead()->take(6)->get(),
        ]);
    }
}
