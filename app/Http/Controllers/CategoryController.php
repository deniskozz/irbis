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

    /*  public function categoryFilter($id)
    {
        $selectedCategory = Category::find($id);
        $rootCategories = $selectedCategory->rootCategories();
        $products = $selectedCategory->products()->paginate(15);

        return view('catalog', compact('rootCategories', 'products'));
    } */

    public function categoryFilter($id)
    {
        $selectedCategory = Category::find($id);

        // Get all subcategories of the selected category
        $subcategories = $selectedCategory->SubCategory()->pluck('id')->toArray();
        $subcategories[] = $selectedCategory->id;

        $rootCategories = $selectedCategory->rootCategories();
        $products = Product::whereIn('category_id', $subcategories)->paginate(15);

        return view('catalog', compact('rootCategories', 'products'));
    }
}
