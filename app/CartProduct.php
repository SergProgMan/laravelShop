<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class CartProduct
{
    public $productId;
    public $quantity;
    public $price;

    public function __constract($productId){
        $this->productId = $productId;
    }
}
