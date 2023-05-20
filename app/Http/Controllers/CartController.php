<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request, $user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cart->total_product += 1;
                $cart->save();
                $cartItem->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                ]);
            }
        } else {
            $cart = Cart::create([
                'user_id' => $user_id,
                'total_product' => 1,
            ]);
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => 1,
            ]);
        }
        return redirect()->back();
    }

    public function subtractCartItemQuantity(Request $request, $user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if ($cartItem) {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                    $cart->total_product -= 1;
                    $cart->save();
                    $cartItem->save();
                } else {
                    $cartItem->delete();
                    $cart->total_product -= 1;
                    $cart->save();
                }
            }
        }
        return redirect()->back();
    }

    public function addCartItemQuantity(Request $request, $user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cart->total_product += 1;
                $cart->save();
                $cartItem->save();
            }
        }
        return redirect()->back();
    }
}
