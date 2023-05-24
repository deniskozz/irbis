<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function add(Request $request)
    {
        if (Auth::check()) {
            $this->addToUserCart($request);
        } else {
            $this->addToSessionCart($request);
        }

        return redirect()->back();
    }

    private function addToUserCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart ?? Cart::create(['user_id' => $user->id]);

        $product = $cart->products()->where('products.id', $request->product_id)->first();

        if ($product) {
            if ($product->pivot->amount < $product->amount) {
                $product->pivot->amount++;
                $product->pivot->save();
            }
        } else {
            $this->attachProductToCart($cart, $request->product_id);
        }
    }

    private function addToSessionCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = (int)$request->input('quantity', 1);

        $product = Product::find($product_id);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
            $cart[$product_id]['amount'] += $product->price * $quantity; // Update the amount
        } else {
            $cart[$product_id] = [
                'id' => $product_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'amount' => $product->price * $quantity, // Calculate the amount
            ];
        }

        $request->session()->put('cart', $cart);
    }



    private function attachProductToCart($cart, $product_id)
    {
        $price = Product::findOrFail($product_id)->price;
        $cart->products()->attach($product_id, ['price' => $price]);
    }


    public function cartShow()
    {
        $user = Auth::user();
        $cartItems = [];
        $total = 0;

        if ($user) {
            // Get the cart for authenticated user
            $cart = $user->cart()->with('products')->first();

            if ($cart) {
                $cartItems = $cart->products;

                foreach ($cartItems as $product) {
                    $total += $product->pivot->price * $product->pivot->amount;
                }
            }
        } else {
            // Get the cart for guest user
            $cart = Session::get('cart', []);

            if (is_array($cart)) {
                $cartItems = $cart;

                foreach ($cartItems as $key => $product) {
                    $cartItems[$key]['amount'] = $product['price'] * $product['quantity'];
                    $total += $cartItems[$key]['amount'];
                }
            }
        }

        return view('cart', compact('cartItems', 'total', 'user'));
    }







    public function update(Request $request)
    {
        dd($request);
    }

    /*
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
    } */
}
