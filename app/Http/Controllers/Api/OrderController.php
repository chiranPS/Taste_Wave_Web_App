<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OnlineOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = OnlineOrder::all();
        return response()->json($orders, 200);
    }

    /**
     * Store a newly created order.
     */
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

        $order = OnlineOrder::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'total_price' => $request->total_price,
            'phone_number' => $request->phone_number,
            'delivery_method' => $request->delivery_method,
            'delivery_address' => $request->delivery_address,
            'order_items' => $request->order_items,
        ]);

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = OnlineOrder::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }

    /**
     * Update the specified order.
     */
    public function update(Request $request, string $id)
    {
        $order = OnlineOrder::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->update($request->all());

        return response()->json(['message' => 'Order updated successfully', 'order' => $order], 200);
    }

    /**
     * Remove the specified order.
     */
    public function destroy(string $id)
    {
        $order = OnlineOrder::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
