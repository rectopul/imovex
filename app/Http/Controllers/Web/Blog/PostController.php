<?php

namespace App\Http\Controllers\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::wherePublished();

        if($request->has('limite')) {
            $posts = $posts->take($request->get('limite'));
        }	

		if($request->has('categoria')) {            
            $posts->whereHas('categories', function($category) use ($request){
                $category->where('name', $request->categoria);
            });
        }

		return $posts->get();
    }

    public function show(Post $post)
    {
        return view('web.blog.post.show',[
            'post' => $post->load(['approvedComments', 'categories']),
            'posts' => Post::mostRead()->take(4)->get(),
            'categories' => PostCategory::mostRead()->take(6)->get(),
        ]);
    }
}
