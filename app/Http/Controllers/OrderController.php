<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\UserOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $carts = Cart::where('user_id', auth()->user()->id)
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->get();
        
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->price * $cart->quantity;
        }

        return view('dashboard.polluxui.customer.checkout', compact('carts', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    
    {
        $carts = Cart::where('user_id', auth()->user()->id)
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->get();

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->price * $cart->quantity;
        }

        $order = Order::create([
            'order_address' => $request->order_address,
            'total_price' => $total
        ]);
        
        foreach ($carts as $cart) {
            ProductOrder::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'amount' => $cart->quantity
            ]);

            Product::where('id', $cart->product_id)
                ->decrement('stock', $cart->quantity);
        }

        UserOrder::create([
            'user_id' => auth()->user()->id,
            'order_id' => $order->id,
            'ordered_at' => now()
        ]);


        //delete cartitem and cart after order
        foreach ($carts as $cart) {
            CartItem::where('cart_id', $cart->cart_id)->delete();
        }
        Cart::where('user_id', auth()->user()->id)->delete();

        return redirect('/myorders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
