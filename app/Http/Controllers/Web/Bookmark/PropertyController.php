<?php

namespace App\Http\Controllers\Web\Bookmark;

use App\Http\Controllers\Controller;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        return PropertyService::take(15, $request->pagina);
    }
}
