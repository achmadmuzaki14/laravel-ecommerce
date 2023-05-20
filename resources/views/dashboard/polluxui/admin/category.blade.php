@extends('dashboard.polluxui.partials.master')

@section('title')
    Store Categories
@endsection

@section('content')
    @if (Auth::user()->role == 'admin')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body justify-content-center">
                    <h4 class="card-title">Add New Product Category</h4>
                    <p class="card-description">
                        Insert new product category here
                    </p>
                    <form action="/category" method="post" class="form-inline d-flex justify-content-between">
                        @csrf
                        @method('post')
                        <label class="sr-only" for="inlineFormInputName2">Category</label>
                        <input type="text" class="col-10 form-control mb-2" name="name" id="inlineFormInputName2"
                            placeholder="Electronic">
                        <button type="submit" class="btn btn-primary mb-2">Add Category</button>

                        @if ($errors->has('category'))
                            <div class="col-12 alert alert-danger">
                                <p>{{ $errors->first('category') }}</p>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Category</h4>
                    <p class="card-description">
                        See available product category in our shop
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $item->name }}</td>
                                        <td class="d-flex justify-content-center">

                                            <form action="/category/{{ $item->id }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a href="/category/{{ $item->id }}/edit">
                                                    <button type="button" class="btn btn-info btn-icon-text mx-2">
                                                        Edit
                                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                                    </button>
                                                </a>

                                                <a href="/products/category/{{ $item->id }}">
                                                    <button type="button" class="btn btn-warning btn-icon-text mx-2">
                                                        <i class="typcn typcn-shopping-bag btn-icon-prepend"></i>
                                                        See Products
                                                    </button>
                                                </a>

                                                <button type="submit" class="btn btn-danger btn-icon-text mx-2">
                                                    <i class="typcn typcn-trash btn-icon-prepend"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">There's no category</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
                    <div class="row flex-grow">
                        <div class="col-lg-7 mx-auto text-white">
                            <div class="row align-items-center d-flex flex-row">
                                <div class="error-page-divider text-lg-left pl-lg-4">
                                    <h2>SORRY! You dont have access :)</h2>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 text-center mt-xl-2">
                                    <a class="text-white font-weight-medium" href="{{ url('product') }}">Back to home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
