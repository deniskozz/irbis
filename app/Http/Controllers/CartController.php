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
        }

        return view('cart', compact('cartItems', 'total', 'user'));
    }

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
        $quantity = (int) $request->quantity;
        $productId = $request->product_id;

        if ($this->canAddToCart($cart, $productId, $quantity)) {
            $product = $cart->products()->where('products.id', $productId)->first();

            if ($product) {
                $cart->products()->updateExistingPivot($productId, [
                    'amount' => $product->pivot->amount + $quantity
                ]);
            } else {
                $product = Product::findOrFail($productId);
                $price = $product->price;

                $cart->products()->attach($productId, [
                    'price' => $price,
                    'amount' => $quantity
                ]);
            }
        }
    }

    private function canAddToCart($cart, $productId, $quantity)
    {
        $product = $cart->products()->where('products.id', $productId)->first();

        if ($product && $product->pivot->amount >= $product->amount) {
            return false;
        }

        return true;
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

    public function deleteFromCart(Product $product)
    {
        // Находим текущую корзину пользователя
        $cart = auth()->user()->cart;

        // Удаляем товар из связи "многие ко многим" с помощью метода detach
        $cart->products()->detach($product->id);

        return redirect()->back()->with('success', 'Товар успешно удален из корзины.');
    }
}
