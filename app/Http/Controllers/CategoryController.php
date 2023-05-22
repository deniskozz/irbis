<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $rootCategories = $category->rootCategories();
        $products = Product::paginate(15);

        return view('catalog')->with(compact('rootCategories', 'products'));
    }

    public function categoryFilter($id)
    {
        $selectedCategory = Category::with('subCategory')->find($id);
        $subcategories = $selectedCategory->subCategory->pluck('id')->push($selectedCategory->id);
        $rootCategories = $selectedCategory->rootCategory ? [$selectedCategory->rootCategory] : $selectedCategory->rootCategories();
        $products = Product::whereIn('category_id', $subcategories)->paginate(15);

        return view('catalog', compact('rootCategories', 'products'));
    }
}
