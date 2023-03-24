<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class CityController extends Controller
{
    public function index()
    {
        return Property::whereNotNull('cidade')->orderBy('cidade')->distinct()->get('cidade')->pluck('cidade')->sort();
    }
}
