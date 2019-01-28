<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;

class CartController extends Controller
{
    public function show()
    {
        $cart = Cart::get();
        return view ('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $cart = Cart::get();
        $product = Product::find($request->product_id);
        if(!$product){
            abort(404);
        }
         
      $cart->add($product);

      return $cart;
    }
}
