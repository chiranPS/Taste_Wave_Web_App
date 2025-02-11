<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Kreait\Firebase\Database;

class TemplateController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'customerfeedbacks';
    }

    public function index()
    {
        $customerfeedbacks = $this->database->getReference($this->tablename)->getValue();
        $data = Product::all();
        $user = auth()->user();
        $count = $user ? Cart::where('email', $user->email)->count() : 0;
        return view('pages.home', compact('data', 'user', 'count','customerfeedbacks'));
    }

    public function index1()
    {
        $data = Product::all();
        $user = auth()->user();
        $count = $user ? Cart::where('email', $user->email)->count() : 0;
        return view('pages.menu', compact('data', 'user', 'count'));
    }

    public function index2()
    {
        $user = auth()->user();
        $count = $user ? Cart::where('email', $user->email)->count() : 0;
        return view('pages.book', compact('user', 'count'));
    }

    public function index3()
    {
        $user = auth()->user();
        $count = $user ? Cart::where('email', $user->email)->count() : 0;
        return view('pages.about', compact('user', 'count'));
    }
    public function feedback(){

        return view('pages.feedback');
    }
}
