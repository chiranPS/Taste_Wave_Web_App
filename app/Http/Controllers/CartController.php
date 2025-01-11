<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CartController extends Controller
{
    public function showcart()
    {
        $user=auth()->user();
        return view('pages.showcart');
    }
}
