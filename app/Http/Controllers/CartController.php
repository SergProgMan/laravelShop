<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{
    public function show()
    {
        $cart = Cart::get();
        return view ('cart', compact('cart'));
    }

    public function add()
    {

    }
}
