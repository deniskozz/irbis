<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        if (!is_int($quantity)) {
            $quantity = 1;
        }

        $product = Product::find($product_id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            $cart[$product_id] = [
                'id' => $product_id, // Добавляем ключ 'id' со значением $product_id
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function cartShow()
    {

        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $key => $product) {
            if (isset($product['id'])) {
                $total += $product['price'] * $product['quantity'];
            } else {
                unset($cart[$key]); // Удаляем продукт из корзины, если у него нет id
            }
        }

        return view('cart', compact('cart', 'total'));
    }


    public function update(Request $request)
    {
        // Get the product ID and new quantity from the request
        $product_id = $request->input('product_id');
        $newQuantity = $request->input('newQuantity');
        dd($product_id);
        // Get the cart from the session
        $cart = $request->session()->get('cart', []);

        // Find the product in the cart and update quantity
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] = $newQuantity;
            $cart[$product_id]['sum'] = $cart[$product_id]['price'] * $newQuantity;
        }

        // Update session with the new cart
        $request->session()->put('cart', $cart);

        // Update the quantity in the database
        $user = auth()->user();
        $user->products()->updateExistingPivot($product_id, ['amount' => $newQuantity]);

        // Calculate total amount
        $total = collect($cart)->sum('sum');

        // Return product and total amount in JSON format
        return response()->json([
            'product' => $cart[$product_id],
            'total' => $total
        ]);
    }
}
