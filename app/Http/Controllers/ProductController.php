<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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

    public function productPage($category, $product){
        $currentProduct = Product::find($product);
        return view('product', compact('currentProduct'));
    }
}
