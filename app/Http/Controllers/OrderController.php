<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myorders()
    {
        $orders = Auth::user()->orders;
        return view('pages.myorders', compact('orders'));
    }
}

