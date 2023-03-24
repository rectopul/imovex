<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        return view('web.catalog.index');
    }
}
