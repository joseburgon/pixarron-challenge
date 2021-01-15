<?php

namespace App\Http\Controllers\api\v1\order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->paginate();

        return OrderCollection::make($orders);
    }


    public function show(Order $order)
    {
        return OrderResource::make(
            $order->load('user')
        );
    }
}
