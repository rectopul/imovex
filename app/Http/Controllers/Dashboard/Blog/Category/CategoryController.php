<?php

namespace App\Http\Controllers\Dashboard\Blog\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blog\Post\CategoryRequest;
use App\Models\PostCategory;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return CategoryService::dataTable();
        }

        return view('dashboard.blog.category.index');
    }

    public function create()
    {
        return view('dashboard.blog.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = CategoryService::create($request->validated());

        $this->setAlertSuccess('Categoria <strong>'.$category->name.'</strong> cadastrada!');

        return $this->sendSuccessResponse([
            'redirect' => route('dashboard.blog.category.index')
        ]);
    }

    public function edit(PostCategory $category)
    {
        return view('dashboard.blog.category.create', compact('category'));
    }

    public function update(CategoryRequest $request, PostCategory $category) {

        $category = CategoryService::update($request->validated(), $category);

        $this->setAlertSuccess('Categoria <strong>'.$category->name.'</strong> atualizada!');

        return $this->sendSuccessResponse([
            'redirect' => route('dashboard.blog.category.index')
        ]);

    }

    public function destroy(PostCategory $category)
    {
        $category = CategoryService::destroy($category);

        if($category) {
            return $this->sendSuccessResponse([
                'reloadDatatable' => 'category-table',
                'message' => 'A categoria <strong>'.$category->name.'</strong> foi removida!'
            ]);
        }

        return response()->json([
            'message' => 'A categoria não pode ser removida, existem posts relacionados!'
        ], 422);

        
    }
}
