<?php

namespace App;

class Cart
{

    public $products = [];

    private static $carInstance = null;

    private function __constrct(){}

    public static function get()
    {
        if(self::$carInstance == null){
            $request = app('Illuminate\Http\Request');
            self::$carInstance = $request->session()->get('cart', function() use ($request){
                $cart = new Cart;
                $request->session()->put('cart',$cart);
                return $cart;
            }); 
        }
        return self::$carInstance;       
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

    public function update($productId, $quantity)
    {
        if($quantity <= 0){
            return;
        }

        if(!isset($this->products[$productId])){
            return;
        }

        $this->products[$productId]->quantity = intval($quantity);
    }

    public function delete($productId){
        if(!isset($this->products[$productId])){
            return;
        }

        unset($this->products[$productId]);
    }

    public function clear(){
        $this->products = [];
    }

    public function __toString(){
        $cartObj = [];
        $productsData = [];
        foreach($this->products as $product){
            $currProduct = [
                'productId' => $product -> productId,
                'price' => $product -> price,
                'quantity' => $product -> quantity,
                'totalPrice' => $product -> getTotalPrice(),
            ];
            $productsData[$product->productId] = $currProduct;
        }

        $cartObj['products'] = $productsData;
        $cartObj['cartProductsCount'] = $this->getCartProductsCount();
        $cartObj['cartTotalPrice'] = $this->getTotalPrice();
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
        $totalPrice = 0;
        foreach($this->products as $product){
            $totalPrice += $product->getTotalPrice();
        }
        return $totalPrice;

    }

    public function isEmpty(){
        return count($this->products) == 0;
    }
}
