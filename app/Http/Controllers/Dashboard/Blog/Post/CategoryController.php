<?php

namespace App\Http\Controllers\Dashboard\Blog\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blog\Post\CategoryRequest;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return PostCategory::orderBy('name')->get();;
    }

    public function store(CategoryRequest $request)
    {
        PostCategory::create($request->only(['name']));
    }
}
