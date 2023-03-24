<?php

namespace App\DataTables;

use App\Models\Faq;

class FaqDataTable
{
    public function render()
    {
        return datatables()->of(Faq::withCount('views'))
        ->addColumn('faq', function($faq){
            return view('dashboard.faq.card', compact('faq'));
        })
        ->filter(function($query){

            if(request()->has('search')) {
                $query->where(function($query){
                    $query
                    ->where('title', 'like', '%'.request()->search['value'].'%')
                    ->orWhere('description', 'like', '%'.request()->search['value'].'%');
                });
            }

            if(request()->has('created_at')) $query->orderBy('created_at', 'DESC');
            if(request()->has('old')) $query->orderBy('created_at', 'ASC');
            if(request()->has('updated_at')) $query->orderBy('updated_at', 'DESC');
            if(request()->has('alpha')) $query->orderBy('title', 'ASC');

        })
        ->toJson();
    }
}