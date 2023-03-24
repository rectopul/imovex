<?php

namespace App\Services;

use App\Models\{Post, Visitor, PostView};
use Illuminate\Support\Facades\File;
use App\DataTables\PostDataTable;
use Carbon\Carbon;
use Auth;

class PostService
{

	public static function dataTable()
	{
		return (new PostDataTable)->render();
	}

	public static function create($data)
	{
		$post = new Post($data);

        if(isset($data['cover'])) {
        	$post->cover = request()->file('cover')->store('blog', 'public_upload');
        }

		$post->user_id = Auth::id();
        
        $post->save();

        if(isset($data['categories'])) {
            $post->categories()->attach(explode(',', $data['categories']));
        }
        
        return $post;
	}

	public static function update(Post $post, $data)
	{
		$post->fill($data);

		if(request()->hasFile('cover')) {
		    
			File::delete(public_path('img/'.$post->getAttributes()['cover']));
		    
		    $post->cover = request()->file('cover')->store('blog', 'public_upload');
		}

		$post->save();

		if(request()->categories) {
		    $post->categories()->detach();
		    $post->categories()->attach(explode(',', request()->categories));
		}

		return $post;
	}

	public static function delete(Post $post) 
	{
		if($post->cover)  File::delete($post->cover);
		
		$clone = $post;

		$post->categories()->detach();
		$post->views()->delete();
		$post->comments()->delete();
		$post->delete();

		return $clone;
	}

	public static function togglePublish(Post $post)
	{
		$post->publish = $post->publish ? null : Carbon::now()->format('d/m/Y');

		$post->save();

		return $post;
	}

	public static function visitPost(Post $post, Visitor $visitor) 
	{
		PostView::firstOrCreate(
			[
				'post_id' => $post->id,
				'visitor_id' => $visitor->id
			],
			[
				'viewed_at' => Carbon::now()
			]
		);
	}

	public static function take($limit) 
	{
		return Post::take($limit)->get();
	}

	public static function takePublished($limit, $search = null) 
	{
		$posts = Post::wherePublished()->take($limit);

		// if($search['categoria']) {            
        //     $posts->whereHas('categories', function($category) use ($search){
        //         $category->where('name', $search['categoria']);
        //     });
        // }

		return $posts->get();
	}

	public static function takePublishedForHome($limit) 
	{
		return Post::wherePublished()
		->where('at_home', true)
		->take($limit)->get();
	}
}