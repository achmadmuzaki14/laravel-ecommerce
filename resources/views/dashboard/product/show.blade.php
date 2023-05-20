@extends('dashboard.polluxui.partials.master')

@section('content')
<br>
<h3>Detail Product</h3>
<br>
<div class="card m-4">
    <div class="konten m-4">
        <h3>{{ $product->name }}</h3>
    <img src="{{ asset('images/'.$product->picture) }}" width="200px">
    <div class="opacity-50"><p>Stock : {{ $product->stock }}</p></div>
    <p>{{ $product->description }}</p>
    <h5>Rp : {{ $product->price }}</h5>
    <form action="" method="post">
        @csrf
        @method('delete')
        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary btn-sm">Edit Product</a>
    </form>
</div>
</div>
@endsection