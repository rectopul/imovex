<?php

namespace App\Http\Controllers\Web\Search;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::search(['busca' => $request->search])
        ->orderBy('id', 'desc')
        ->take($request->records)
        ->get();

        return $properties;
    }
}
