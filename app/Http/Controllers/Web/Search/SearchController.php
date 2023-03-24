<?php

namespace App\Http\Controllers\Web\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {   
        if(!$request->q) {
            return redirect()->route('web.home.index');
        }

        return view('web.search.index');
    }
}
