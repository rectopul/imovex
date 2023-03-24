<?php

namespace App\Http\Controllers\Web\History;

use App\Http\Controllers\Controller;
use App\Services\PropertyService;

class PropertyController extends Controller
{
    public function index()
    {
        return PropertyService::visitorHistory();
    }
}
