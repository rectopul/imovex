<?php

namespace App\DataTables;

use App\Models\PostComment;
use Carbon\Carbon;

class PostCommentDataTable
{

    public function render()
    {
        Carbon::setLocale('pt_BR');

        return datatables()->of($this->query())
            ->addColumn('comment', function($comment){

                return view('dashboard.blog.comment.card', compact('comment'));

            })
            ->filter(function($query) {

                if(request()->has('search')) {
                    $query->where(function($query){
                        $query
                        ->where('name', 'like', '%'.request()->search['value'].'%')
                        ->orWhere('body', 'like', '%'.request()->search['value'].'%')
                        ->orWhereHas('post', function($query) {
                            $query->where('title', 'like', '%'.request()->search['value'].'%');
                        });
                    });
                }
                
                if(request()->has('status')) {

                    if(request()->status != '*') {

                        if(request()->status == 'SM') {
                            $query->where('status', null);      
                        } else {
                            $query->where('status', request()->status);
                        }

                    }
                }

                if(request()->created_at == 'ASC') $query->orderBy('created_at', 'ASC');
                if(request()->created_at == 'DESC') $query->orderBy('created_at', 'DESC');

            })
            ->toJson();
    }

    private function query()
    {
        return PostComment::with('post');
    }
}
