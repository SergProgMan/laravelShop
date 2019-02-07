<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\Order;
use App\OrderProduct;
use Illuminate\Support\Facades\Log; 
use App\Library\FondyHelper;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function create()
    {
        $cart = Cart::get();

        $user = Auth::user();
        return view('orders.confirm_form', compact('cart', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:100',
            'np_city' => 'max:255',
            'np_warehouse' => 'max:255',
            'phone' => 'required|max:20',
            'comment' => 'max:1000', 
        ]);

        $cart = Cart::get();
        $order = null;

        DB::transaction(function () use ($request, $cart, &$order) {
            $order = new Order;
            $order->fill($request->all());
            $order->status = Order::STATUS_ACCEPTED;

            $user = Auth::user();
            if ($user) {
                $order->user()->associate($user);
            }

            $order->save();
    
            foreach ($cart->products as $cartProduct) {
                $orderProduct = new OrderProduct;
    
                $orderProduct->quantity = $cartProduct->quantity;
    
                $realPrice = $cartProduct->realProduct()->price;  
                $cartPrice = $cartProduct->price; 
                $maxDiff = $realPrice * 0.1;
                
                if ($cartPrice < $realPrice - $maxDiff) {
                    $targetPrice = $realPrice;
                } else {
                    $targetPrice = $cartPrice;
                }
    
                $orderProduct->price = $targetPrice;

                $orderProduct->order()->associate($order);
    
                $orderProduct->product()->associate($cartProduct->realProduct());
    
                $orderProduct->save();
            }
        });

        $cart->clear();

        $checkoutData = [
            'currency' => 'USD',
            'amount' => $order->getTotalPrice() * 100,
            'response_url' => 'http://628f06f1.ngrok.io' . route('order.payment_result', [], false),
            'order_id' => 'pc-shop-20190130-' . $order->id,
            'order_desc' => 'Payment for PC SHOP, order ID: ' . $order->id,
            'server_callback_url' => 'http://628f06f1.ngrok.io' . route('order.callback', [], false),
        ];
    
        $paymentUrl = FondyHelper::generateUrl($checkoutData);

        return view('orders.success', compact('paymentUrl'));
    }

    public function paymentResult(Request $request)
    {
        if ($request->response_status == 'success') {
            return view('orders.payment_success');
        } else {
            return view('orders.payment_error');
        }
    }

    public function callback(Request $request)
    {
        $params = json_decode($request->getContent(), true);
        
        if (!FondyHelper::checkRequestData($params)) {
            abort('Incorrect data!', 404);
        }

        $order_id = str_replace('pc-shop-20190130-', '', $params['order_id']);
        $order = Order::find($order_id);
        $order->online_paid_at = new Carbon;
        $order->save();

        return response('SUCCESS', 200);
    }

    public function myOrders()
    {
        $user = Auth::user();
        $orders = $user->myOrders;
        return view('orders.my-orders', compact('orders'));
    }
}
