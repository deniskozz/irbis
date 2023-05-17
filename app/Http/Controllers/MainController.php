<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function contact()
    {
        return view('contact');
    }

    public function admin(){
        if (auth()->check() && auth()->user()->admin) {
            return view('admin');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function catalog(){
        $products = Product::paginate(15);
        $categories = Category::get();
        return view('catalog', compact('products', 'categories'));
    }

    public function categoryFilter($id){
        /* $selectedCategory = Category::find($id); */
        $selectedCategory = Category::find($id);
        $categories = Category::all();
        $products = $selectedCategory->products()->paginate(15);
        return view('catalog', compact( 'categories', 'products'));
    }
}
