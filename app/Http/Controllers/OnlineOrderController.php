<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineOrder;
use App\Models\Cart;

class OnlineOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'user_email' => 'required|email',
            'total_price' => 'required|numeric',
            'phone_number' => 'required|string',
            'delivery_method' => 'required|string',
            'order_items' => 'required|json',
        ]);

        $order = new OnlineOrder();
        $order->user_name = $request->user_name;
        $order->user_email = $request->user_email;
        $order->total_price = $request->total_price;
        $order->phone_number = $request->phone_number;
        $order->delivery_method = $request->delivery_method;
        $order->delivery_address = $request->delivery_address;
        $order->order_items = $request->order_items;
        $order->is_completed = false;
        $order->save();

        Cart::where('email', auth()->user()->email)->delete();
       return response()->json(['message' => 'Order placed successfully, cart cleared.'], 201);
    }
}
