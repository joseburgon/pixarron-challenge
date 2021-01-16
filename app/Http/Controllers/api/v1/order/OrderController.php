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

        if (auth()->user()->hasRole('admin')) {

            $orders = Order::with('user')->paginate();

            return OrderCollection::make($orders);

        } else {

            return response([
                'message' => 'You don\'t have permission to access this information.'
            ]);

        }

    }


    public function show(Order $order)
    {

        $authUser = auth()->user();

        if ($authUser->hasRole('admin') || $order->user_id === $authUser->id) {

            return OrderResource::make(
                $order->load('user')
            );

        } else {

            return response([
                'message' => 'You don\'t have permission to access this information.'
            ]);

        }

    }
}
