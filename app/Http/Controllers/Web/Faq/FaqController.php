<?php

namespace App\Http\Controllers\Web\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->has('letra')) {
                return Faq::byLetter($request->letra)->get();
            }
        }

        $mostViewedFaq = Faq::mostViewedAtMonth()->first();

        return view('web.faq.index', compact('mostViewedFaq'));
    }

    public function show(String $index, Faq $faq) 
    {
        return view('web.faq.index', compact('faq'));
    }
}
