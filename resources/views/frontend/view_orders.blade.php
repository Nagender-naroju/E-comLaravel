@extends('layouts.front')

@section('title')
 My Orders
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sw bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 " >Collections / View Orders Details</h6>
    </div>
</div>
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-info">View Order
            <a class="btn btn-danger float-end" href="{{url('/my-orders')}}">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Basic Details</h6>
                    <hr>
                    <form action="">
                        <div class="mt-2">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $user->fname }}">
                        </div>
                       <div  class="mt-2">
                          <label for="last_name">Last Name</label>
                          <input type="text" class="form-control" name="last_name" value="{{ $user->lname }}">
                       </div>
                       <div  class="mt-2">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                       </div>
                       <div  class="mt-2">
                          <label for="mobile_number">Contact No</label>
                          <input type="text" class="form-control" name="mobile_number" value="{{ $user->phone }}">
                       </div>
                       <div  class="mt-2">
                          <label for="state">State</label>
                          <input type="text" class="form-control" name="state" value="{{ $user->state }}">
                       </div>
                       <div  class="mt-2">
                          <label for="city">City</label>
                          <input type="text" class="form-control" name="city" value="{{ $user->city }}">
                       </div>
                       <div  class="mt-2">
                          <label for="address">Shipping Address</label>
                          <input type="text" class="form-control" name="address" value="{{ $user->address_1 }}">
                       </div>
                       <div  class="mt-2">
                          <label for="pin_code">Pincode</label>
                          <input type="text" class="form-control" name="pin_code" value="{{ $user->pincode }}">
                       </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h6>Order Details</h6>
                    <hr>
                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $ord)
                                @foreach ($ord as $row)
                                    <tr>
                                        <td><img src="{{ asset('uploads/products/'.$row->products->image) }}" width="100px" alt=""></td>
                                        <td>{{ $row->products->name }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>Rs : {{ $row->products->selling_price*$row->qty }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection