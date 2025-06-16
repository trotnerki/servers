<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('products');

        return view('categories.index', [
            'categories' => collect([$category]),
            'singleCategoryView' => true
        ]);
    }
}
