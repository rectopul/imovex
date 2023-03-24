<?php 

namespace App\DataTables;

use App\Models\PostCategory;

class CategoryDataTable
{
    public function render()
    {
        return datatables()->of($this->query())
            ->addColumn('category', function($category){
                return view('dashboard.blog.category.card', compact('category'));
            })
            ->filter(function($query){
                
                if(request()->has('search')) {
                    $query->where('name', 'like', '%'.request()->search['value'].'%');
                }

                if(request()->has('views')) {
                    $query->orderBy('views_count', request()->get('views'));
                }

                if(request()->has('posts')) {
                    $query->orderBy('posts_count', request()->get('posts'));
                }

            })
            ->toJson();
    }

    private function query()
    {
        return PostCategory::withCount(['posts', 'views']);
    }

    private function filter($query)
    {
        if(request()->has('search')) {
            $query->where('name', 'like', '%'.request()->search['value'].'%');
        }

        if(request()->has('views')) {
            $query->orderBy('views_count', request()->get('views'));
        }

        if(request()->has('posts')) {
            $query->orderBy('posts_count', request()->get('posts'));
        }
    }
}