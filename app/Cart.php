<?php

namespace App;

class Cart
{

    public $products = [];

    private static $carInstance = null;

    private function __constrct(){}

    public static function get()
    {
        $request = app('Illuminate\Http\Request');
        return $request->session()->get('cart', function() use ($request){
            $cart = new Cart;
            $request->session()->put('cart',$cart);
            return $cart;
        });
    }

    public function add($product)
    {
        $productId = $product->id;

        if(isset($this->products[$productId])){
            $cartProduct = $this->products[$productId];
            $cartProduct -> quantity++;
        } else {
            $cartProduct= new CartProduct($product);
            $this->products[$productId] = $cartProduct;
        }
    }

    public function __toString(){
        $cartObj = [];
        $cartObj['products'] = $this->products;
        $cartObj['cartProductsCount'] = $this->getCartProductsCount();
        return json_encode($cartObj);
    }

    public function getCartProductsCount(){
        $count = 0;
        foreach ($this->products as $product){
            $count += $product->quantity;
        } 
        return $count;
    } 

    public function getTotalPrice(){
        $price = 0;
        foreach($this->products as $product){
            $price += $product->getTotalPrice();
        }
        return $price;

    }
}
