<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TemplateController extends Controller
{
    public function index()
    {
        $data=product::all();
        return view('pages.home',compact('data'));
    }

    public function index1()
    {
        $data=product::all();
        return view('pages.menu',compact('data'));
    }

    public function index2()
    {
        return view('pages.book');
    }

    public function index3()
    {
        return view('pages.about');
    }
}
