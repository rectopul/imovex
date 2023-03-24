<?php

namespace App\DataTables;

use App\Models\Post;
use Carbon\Carbon;

class PostDataTable
{

    public function render()
    {
        Carbon::setLocale('pt_BR');

        return datatables()->of($this->query())

        ->addColumn('post', function($post) {

            return view('dashboard.blog.post.card', compact('post'));

        })

        ->filter(function($query) {
            
            if(request()->has('search')) {
                $query->where('title', 'like', '%'.request()->search['value'].'%');
            }

            if(request()->has('categories')) {
                $query->whereHas('categories', function($posts) {
                    $posts->whereIn('category_id', request()->categories);
                });
            }

            if(request()->has('users')) {
                $query->whereHas('user', function($posts) {
                    $posts->whereIn('user_id', request()->users);
                });
            }

            if(request()->has('status')) {

                if(request()->status == 'published') {

                    $query->where('publish', '<=', now());

                } else if(request()->status == 'unpublished') {

                    $query->where('publish', null);

                } else if(request()->status == 'scheduled') {

                    $query->where('publish', '>', now());

                } else if(request()->status == 'home') {

                    $query->where('at_home', true);

                } else {

                    $query;

                }
            }

            if(request()->has('sort')) {

                $sort = request()->get('sort');

                switch ($sort) {
                    
                    case 'newest':
                        $query->orderBy('created_at', 'DESC');
                        break;
                    
                    case 'oldest':
                        $query->orderBy('created_at', 'ASC');
                        break;

                    case 'updated_at':
                        $query->orderBy('updated_at', 'DESC');
                        break;
                    
                    case 'alpha':
                        $query->orderBy('title', 'ASC');
                        break;
                }

            }

        })
        ->toJson();
    }

    private function query()
    {
        return Post::with('categories', 'user')
            ->withCount(['comments', 'views'])
            ->orderBy('highlight', 'DESC');
    }
}
