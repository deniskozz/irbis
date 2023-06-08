<?php

namespace App\Http\Controllers;

use App\Mail\Order as MailOrder;
use Illuminate\Support\Facades\Mail;
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
        $order = $user->orders()->create([
            'cart_id' => $cart->id,
            'status' => 0,
        ]);
        $user->cart()->create();
        Mail::to($user->email)->send(new MailOrder($user));
        return redirect('/');
    }

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('orders', compact('orders'));
    }

    public function updateStatus(Order $order, Request $request)
    {
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Статус заказа успешно обновлен.');
    }


    public function show(Order $order)
    {
        return view('order_details', compact('order'));
    }
}
