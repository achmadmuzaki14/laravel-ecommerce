@extends('dashboard.polluxui.partials.master')

@section('title')
    My Orders
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
                        <div class="dropdown-item preview-item align-items-center justify-content-center"
                            style="width:10rem;">
                            <form action="/checkout" method="post">
                                @csrf
                                @method('post')
                                <button class="btn btn-primary" type="submit">Order Now</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Products</th>
                        <th>Total Price</th>
                        <th class="text-center">Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customerOrders as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-left">
                                @for ($i = 0; $i < count($item); $i++)
                                    {{ $item[$i]->name }}
                                    @if ($i < count($item) - 1)
                                        ,
                                    @endif
                                @endfor
                            </td>
                            <td class="text-left">
                                <h5>Rp. {{ $orderdetails[$key][0]->total_price }}</h5>
                            </td>
                            <td class="text-center">
                                <a href="/download-invoice/{{ $item[0]->order_id }}">
                                    <button type="button" class="btn btn-info btn-icon-text">
                                        Download Invoice
                                        <i class="typcn typcn-printer btn-icon-append"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">There's no orders yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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