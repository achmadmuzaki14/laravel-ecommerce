<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\UserOrder;
use App\Models\ProductOrder;


class CustomerController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $carts = Cart::where('user_id', auth()->user()->id)
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->get();

        return view('dashboard.polluxui.customer.products', compact('products', 'carts'));
    }

    public function order_index()
    {

        $carts = Cart::where('user_id', auth()->user()->id)
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->get();

        $userorders = UserOrder::where('user_id', auth()->user()->id)->get();

        $customerOrders = [];
        $orderdetails = [];

        foreach ($userorders as $key => $order) {
            $productOrders = ProductOrder::where('order_id', $order->order_id)
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->get();

            $orders = Order::where('id', $order->order_id)->get();

            array_push($customerOrders, $productOrders);
            array_push($orderdetails, $orders);
        }
        


        // $userorders = UserOrder::where('user_id', auth()->user()->id)
        //     ->join('orders', 'user_orders.order_id', '=', 'orders.id')
        //     ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
        //     ->join('products', 'product_orders.product_id', '=', 'products.id')
        //     ->get();

        // $orders = Order::where('user_id', auth()->user()->id)
        //     ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
        //     ->join('products', 'product_orders.product_id', '=', 'products.id')
        //     ->get();

        return view('dashboard.polluxui.customer.orders', compact('carts','customerOrders', 'orderdetails'));
    }
}
