<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('productlist', compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'parameters' => 'required',
            'price' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $product = Product::create($data);

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $product->img = $request->file('img')->store('public/products');
            $product->save();
        }

        return redirect()->route('productlist')
            ->with('success', 'Product has been created successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('productlist')
            ->with('success', 'Product has been successfully deleted');
    }


    public function productPage($category, $product)
    {
        $currentProduct = Product::find($product);
        $relatedProducts  = Product::where('category_id', $currentProduct->category_id)->get();
        return view('product', compact('currentProduct', 'relatedProducts'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('edit', compact('product', 'categories'));
    }

    public function update(Request $request)
    {
        $productToUpdate = Product::find($request->id);
        $productToUpdate->update([
            'name' => $request->name,
            'description' => $request->description,
            'parameters' => $request->parameters,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('img')) {
            $productToUpdate->img = $request->file('img')->store('public/products');
            $productToUpdate->save();
        }

        return redirect()->route('productlist');
    }
}
