<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\Order;
use App\OrderProduct;


class OrdersController extends Controller
{
    public function create()
    {
        $cart = Cart::get();
        $user = Auth::user();
        return view ('order_form', compact('cart', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:100',
            'street' => 'max:200',
            'city' => 'max:200',
            'phone' => 'required|max:20',
            'comment' => 'max:1000',
        ]);

        $cart = Cart::get();
        $order = null;

        DB::transaction(function() use ($request, $cart, &$order){
            $order = new Order;
            $order->fill($request->all());
    
            $user = Auth::user();
            if($user){
                $order->user->associate($user);
            }

            $order->save();
    
            foreach ($cart->product as $cartProduct){
                $orderProduct = new OrderProduct;
    
                $orderProduct->quantity = $cartProduct->quantity;
    
                $realPrice = $cartProduct -> realProduct()->price;
                $cartPrice = $cartProduct->price;
                $maxDiff = $realPrice * 0.1;
    
                if($cartPrice < $realPrice-$maxDiff){
                    $targetPrice = $realPrice;
                } else {
                    $targetPrice = $cartPrice;
                }
    
                $orderProduct->price = $targetPrice;
    
                $orderProduct->order()->assocaite($order);
    
                $orderProduct->product()->associate($cartProduct->realProduct());
    
                $orderProduct->save();
            }
        });
       
        $cart->clear();

        return view('order_success');
    }

    public function myOrders(){
        $user = Auth::user();
        $orders = $users->myOrders;
        return view('orders.my-orders', compact('orders'));
    }
}
