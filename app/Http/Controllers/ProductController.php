<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use File;
use App\Models\Cart;

class ProductController extends Controller
{
    public function index()
    {
        $product = DB::table('products')->get()->all();

        return view('dashboard.polluxui.admin.index-product', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'picture' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ],
        [
            'name.required' => 'Harap Masukkan Nama Produk',
            'stock.required' => 'Harap Masukkan Jumlah Stock Product',
            'description.required' => 'Harap Masukkan Description Produk',
            'picture.required' => 'Harap Masukkan Foto Produk',
            'price.required' => 'Harap Masukkan Harga Produk',
            'category_id.required' => 'Harap Masukkan Kategori Produk',
        ]
    );

        $fileName = time().'.'.$request->picture->extension();

        $category = new Product;

        $category->name = $request->name;
        $category->stock = $request->stock;
        $category->description = $request->description;
        $category->picture = $fileName;
        $category->price = $request->price;
        $category->category_id = $request->category_id;

        $category->save();
        $request->picture->move(public_path('images'), $fileName);

        return redirect('product')->with('success', 'Data anda berhasil ditambahkan');
    }

    public function create(){
        $category = Category::all();

        return view ('dashboard.polluxui.admin.create-product', compact('category'));
    }

    public function edit($id){
        $category = Category::all();
        $product = Product::findorfail($id);

        return view('dashboard.polluxui.admin.edit-product', compact('product', 'category'));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('dashboard.product.show', compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'picture' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ],
        [
            'name.required' => 'Harap Masukkan Nama Produk',
            'stock.required' => 'Harap Masukkan Jumlah Stock Product',
            'description.required' => 'Harap Masukkan Description Produk',
            'picture.required' => 'Harap Masukkan Foto Produk',
            'price.required' => 'Harap Masukkan Harga Produk',
            'category_id.required' => 'Harap Masukkan Kategori Produk',
        ]
    );

    $product = Product::findOrFail($id);

    if($request->has('picture'))
        {

            $path = "images/";
            File::delete($path . $product->picture);

            $fileName = time().'.'.$request->picture->extension();
            $request->picture->move(public_path('images'), $fileName);

            $product_data = 
            [
                'name' =>$request->name,
                'stock' =>$request->stock,
                'description' =>$request->description,
                'picture' =>$fileName,
                'price' =>$request->price,
                'category_id' =>$request->category_id
            ];

        }else
            {
                $product_data = 
                [
                    'name' =>$request->name,
                    'stock' =>$request->stock,
                    'description' =>$request->description,
                    'picture' =>$request->picture,
                    'price' =>$fileName,
                    'category_id' =>$request->category_id
                ];
            }
        $product->update($product_data);

        return redirect('/product');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $path = "/images";
        File::delete($path, $request->picture);
        $product->delete();

        return redirect('product');
    }

    public function search(Request $request, $product_name)
    {
        $search = $request->get('search');
        $products = Product::where('name', 'LIKE', '%'.$product_name.'%')->get();

        $carts = Cart::where('user_id', auth()->user()->id)
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->get();

        return view('dashboard.polluxui.customer.productsBySearch', compact('products', 'carts'));
    }
}