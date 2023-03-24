<?php

namespace App\Http\Controllers\Web\Search;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')) {
            return Faq::where('title', 'like', '%'.$request->get('search').'%')
            ->orderBy('title')
            // ->limit($request->get('records') ?? 10)
            ->get()
            ->groupBy(function($item, $key){
        
                return $item->title[0];
        
            });
        }

    }
}
