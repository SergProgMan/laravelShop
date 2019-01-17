<?php

namespace App;

class Cart
{

    public $products = [];

    public static function get(){
        $request = app('Illuminate\Http\Request');
        return $request->session()->get('cart', function() use ($request){
            $cart = new Cart;
            $request->session()->put('cart',$cart);
            return $cart;
        });
    }

    public function add($productId){
        if(isset($this->products[$productId])){
            $cartProduct = $this->products[$productId];
            $cartProduct -> quantity++;
        } else {
            $cartProduct= new CartProduct($productId);
            $this->products[$productId] = $cartProduct;
        }
         
    }

    public function all(){
        return $this->products; 
    }
}
