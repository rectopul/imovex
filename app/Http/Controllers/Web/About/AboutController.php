<?php

namespace App\Http\Controllers\Web\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('web.about.index');
    }
}
