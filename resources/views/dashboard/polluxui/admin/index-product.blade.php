@extends('dashboard.polluxui.partials.master')

@section('content')
@if (Auth::user()->role == 'admin')
<div class="col-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body justify-content-center">
          <h4 class="card-title">Add New Product Product</h4>
          <div class="d-flex justify-content-between">
            <div class="description">
          <p class="card-description">
              Insert new product here
          </p>
        </div>
        <div class="tomboladd">
          <a href="{{ route('product.create') }}" type="submit" class="btn btn-primary">Tambah Product</a>
        </div>
        </div>
      </div>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header">
      Data Product
  </div>
  <div class="table-responsive">
      <table class="table table-striped m-3">
          <thead>
              <tr>
                  <th scope="col">No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Description</th>
                  <th scope="col">Price</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($product as $key => $item)

              <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->stock }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->price }}</td>
                  <td>
                      <form action="{{ url('product',$item->id) }}" method="POST">
                          @csrf
                          @method('delete')
                          <a href="{{ route('product.show',$item->id) }}" type="submit" class="btn btn-info btn-sm mx-2">Detail Product</a>
                          <a href="{{ route('product.edit',$item->id) }}" type="submit" class="btn btn-warning btn-sm mx-2">Edit Product</a>
                          <input type="submit" class="btn btn-danger btn-sm mx-2" value="DELETE">
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
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