<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showPersonalCabinet()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('personal', compact('orders', 'user'));
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        if (Hash::check($currentPassword, $user->password) && $newPassword === $confirmPassword) {
            $user->password = Hash::make($newPassword);
            $user->save();

            return redirect()->back();
        }

        return redirect()->back()->withErrors('Password change failed.');
    }
}
