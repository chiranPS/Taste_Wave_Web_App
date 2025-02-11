<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addcart(Request $request, $id)
    {
        if(Auth::id()) 
        {
            $user = auth()->user(); 
            $product = Product::find($id); 
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->product_title = $product->product_name;
            $cart->unit_price = $product->product_price;
            $cart->price = $product->product_price * $request->quantity;
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back()->with('message','Product Added Successfully');
        } 
        else 
        {
            return redirect('login'); 
        }
    }

    public function showcart()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('login'); 
        }

        $user = auth()->user();
        $cart = Cart::where('email', $user->email)->get(); 
        $count = Cart::where('email', $user->email)->count(); 

        return view('pages.showcart', compact('count', 'cart'));
    }


    public function deletecart($id)
    {
        $data=Cart::find($id);
        $data->delete();
        return redirect()->back();
    }
}
