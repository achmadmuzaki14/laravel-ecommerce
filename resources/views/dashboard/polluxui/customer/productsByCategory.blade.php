@extends('dashboard.polluxui.partials.master')

@section('title')
    Store Product by Category
@endsection

@section('content')
    <div class="card px-3 py-3">
        <div class="row align-items-center justify-content-between">
            <div class="col-4 nav-item nav-search d-none d-md-block mr-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="search"
                        aria-describedby="search" name="search" id="search">
                    <button type="button" onclick=searchProduct() class="btn btn-primary ml-4">Search</button>
                </div>
            </div>
            <div class="col-2">
                <a class="nav-link count-indicator d-flex align-items-center justify-content-center"
                    id="notificationDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="typcn typcn-shopping-cart mx-0"></i>
                    <sup class="badge badge-danger ml-1">{{ count($carts) }}</sup>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list px-3 py-3"
                    aria-labelledby="notificationDropdown">

                    @forelse ($carts as $item)
                        <div class="dropdown-item preview-item" style="width:10rem;">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <img class="mx-0" src="{{ asset('images/' . $item->picture) }}">
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">{{ $item->name }}</h6>
                                <div
                                    class="row font-weight-light small-text mb-0 text-muted align-items-center justify-content-around">
                                    <form action="/add-quntity/{{ Auth::user()->id }}/{{ $item->id }}" method="post">
                                        @csrf
                                        @method('post')

                                        <button type="submit" class="btn btn-icon">
                                            <i class="typcn typcn-plus"></i>
                                        </button>
                                    </form>
                                    <h5 class="mb-0">{{ $item->quantity }}</h5>
                                    <form action="/subtract-quntity/{{ Auth::user()->id }}/{{ $item->id }}"
                                        method="post">
                                        @csrf
                                        @method('post')

                                        <button type="submit" class="btn btn-icon">
                                            <i class="typcn typcn-minus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <a class="dropdown-item preview-item justify-content-center align-items-center"
                            style="width:10rem;">
                            <p>Nothing here</p>
                        </a>
                    @endforelse
                    @if (count($carts) > 0)
                        <div class="dropdown-item preview-item align-items-center justify-content-center" style="width:10rem;">
                            <a href="/checkout">
                                <button class="btn btn-primary" type="button">Order Now</button>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="row px-3 py-3">
            @forelse ($products as $item)
                <div class="col-4">
                    <div class="card my-3" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('images/' . $item->picture) }}" alt="Card image cap"
                            style="width: 286px; height: 195px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex row justify-content-between">
                                <p class="card-title">{{ $item->name }}</p>
                                <p class="card-title text-primary">Rp. {{ $item->price }}</p>
                            </div>
                            <div class="d-flex row justify-content-between align-items-center mb-2">
                                <p class="card-text">Available: {{ $item->stock }}</p>
                            </div>
                            <div class="d-flex">
                                <form action="/add-to-cart/{{ Auth::user()->id }}/{{ $item->id }}" method="post">
                                    @csrf
                                    @method('post')
                                    <button class="btn btn-primary" type="submit">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3>Tidak Ada Produk Terkini</h3>
            @endforelse
        </div>
    </div>
@endsection

@section('script')
    <script>
        //make funtion on button with search document by id "search" then go to link 
        const searchProduct = () => {
            let search = document.getElementById('search').value;
            window.location.href = `/search-products=${search}`;
        }
    </script>
@endsection