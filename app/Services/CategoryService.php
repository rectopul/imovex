<?php 

namespace App\Services;

use App\DataTables\CategoryDataTable;
use App\Models\PostCategory;

class CategoryService
{
    public static function dataTable()
    {
        return (new CategoryDataTable)->render();
    }

    public static function create($data)
    {
        return PostCategory::create(['name' => $data['name']]);
    }

    public static function update($data, PostCategory $category)
    {
        $category->name = $data['name'];
        
        $category->save();

        return $category;
    }

    public static function destroy(PostCategory $category)
    {
        $clone = $category;

        if($category->posts()->exists()) {
            return false;
        }

        $category->delete();

        return $clone;
    }
}