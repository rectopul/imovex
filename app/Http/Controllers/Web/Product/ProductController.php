<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Services\VisitorService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        VisitorService::addPropertyToHistory($id);

        return view('web.product.show', [
            'property' => Property::findOrFail($id)
        ]);
    }
}
