<?php

namespace App\Http\Controllers\Web\Privacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        return view('web.privacy.index');
    }
}
