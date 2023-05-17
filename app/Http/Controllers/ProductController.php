<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();
        return view('productlist', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $product->img = $request->file('img') ? $request->file('img')->store('public/products') : '';
        }

        $product->save();

        return redirect()
            ->route('productlist')
            ->with('success', 'Продукт успешно создан');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        dd($product);
        $product->delete();
        return redirect()
            ->route('productlist')
            ->with('success', 'Продукт успешно удален!');
    }

    public function productPage($category, $product)
    {
        $currentProduct = Product::find($product);
        $sliderProducts = Product::where('category_id', $currentProduct->category_id)->get();
        return view('product', compact('currentProduct', 'sliderProducts'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('edit', compact('product', 'categories'));
    }

    public function update(Request $request)
    {
        $t = Product::find($request->id);
        $t->name = $request->name;
        $t->description = $request->description;
        $t->parameters = $request->parameters;
        $t->price = $request->price;
        $t->category_id = $request->category_id;
        if (isset($request->img)) {
            $t->img = $request->file('img')->store('public/products');
        }
        $t->save();
        return redirect()->route('productlist');
    }
}
