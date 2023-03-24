<?php

namespace App\Http\Controllers\Dashboard\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            
            if($request->has('draw')) {
                return PropertyService::datatable();
            }
            
        }

        return view('dashboard.property.index');
    }

    public function show(Property $property)
    {
        return view('dashboard.property.show', compact('property'));
    }
}
