<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function placeOrder(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart()->with('products')->first();

        $order = new Order();
        $order->cart_id = $cart->id;
        $order->user_id = $user->id;
        $order->status = 0;
        $order->name = $user->name;
        $order->phone = $user->phone;
        $order->save();

        $newCart = new Cart();
        $newCart->user_id = $user->id;
        $newCart->save();

        return redirect('/');
    }
}
