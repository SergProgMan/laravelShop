<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('backOffice.orders.index', compact('orders'));
    }

    public function new()
    {
        $orders = Order::orderBy('created_at', 'desc')->accepted()->paginate(10);
        return view('backOffice.orders.index', compact('orders'));
    }

    public function show(Order $order) 
    {
        return view('backOffice.orders.show', compact('order')); 
    }
}
