<?php

namespace App;

class CartProduct
{
    public $productId;
    public $quantity;
    public $price;

    public function __construct($realProduct)
    {
        $this->productId = $realProduct->id;
        $this->quantity = 1;
        $this->price = $realProduct->price;
    }

    public function realProduct()
    {
        return Product::find($this->productId);
    }

    public function getTotalPrice()
    {
        $value = round($this->quantity * $this->price, 2, PHP_ROUND_HALF_UP);
        return $value;
    }
}
