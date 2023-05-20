<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use PDF;

class PDFController extends Controller
{
    public function generatePDF($order_id)
    {
        // $orderDetails = Order::where('id', $order_id)->get();

        $productDetails = ProductOrder::where('order_id', $order_id)
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->get();

        
        $products = [];
        $total = 0;

        foreach ($productDetails as $key => $prod) {
            $product = [
                'picture' => $prod->picture,
                'name' => $prod->name,
                'price' => $prod->price,
                'quantity' => $prod->amount,
                'total' => ($prod->amount * $prod->price)
            ];

            $total += ($prod->amount * $prod->price);
            array_push($products, $product);
        }
        
        $data = [
            'products' => $products,
            'total' => $total,
            'title' => 'Invoice #'.$order_id,
        ];
          
        $pdf = PDF::loadView('pdf.invoice', $data);
    
        return $pdf->download('Invoice #'.$order_id. '.pdf');
    }
}
