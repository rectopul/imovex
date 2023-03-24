<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonthlyPropertiesController extends Controller
{
    public function index()
    {
        return view('web.catalog.monthly_properties.index');
    }
}
