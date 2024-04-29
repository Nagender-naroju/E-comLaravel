@extends('layouts.front')

@section('title')
 Checkout
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sw bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 " >Collections / Checkout </h6>
    </div>
</div>
<div class="py-5">
<form action="{{ url('/place-order')}}" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control first_name" name="first_name" value="{{Auth::user()->name}}" placeholder="Enter First Name">
                                <span class="text-danger" id="first_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control last_name" name="last_name" value="{{Auth::user()->lname}}" placeholder="Enter Last Name">
                                <span class="text-danger" id="last_error"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="email">Email</label>
                                <input type="text" class="form-control email" name="email" value="{{Auth::user()->email}}" placeholder="Enter Your Email">
                                <span class="text-danger" id="email"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="number" class="form-control mobile_number" name="mobile_number" value="{{Auth::user()->phone}}" placeholder="Enter Phone Number">
                                <span class="text-danger" id="number"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="address_1">Address 1</label>
                                <input type="text" class="form-control address_1" name="address_1" value="{{Auth::user()->address_1}}" placeholder="Enter Address 1">
                                <span class="text-danger" id="address_1"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="address_1">Address 2</label>
                                <input type="text" class="form-control address_2" name="address_2" value="{{Auth::user()->address_2}}" placeholder="Enter Address 2">
                                <span class="text-danger" id="address_2"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="country">Country Name</label>
                                <input type="text" class="form-control country" name="country" value="{{Auth::user()->country}}" placeholder="Enter Country">
                                <span class="text-danger" id="country"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="state">State Name</label>
                                <input type="text" class="form-control state" name="state" value="{{Auth::user()->state}}" placeholder="Enter State">
                                <span class="text-danger" id="state"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="city">City Name</label>
                                <input type="text" class="form-control city" name="city" value="{{Auth::user()->city}}" placeholder="Enter City">
                                <span class="text-danger" id="city"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="pin_code">Pin Code</label>
                                <input type="text" class="form-control pin_code" name="pin_code" value="{{Auth::user()->pincode}}" placeholder="Enter Pin Code">
                                <span class="text-danger" id="pinCode"></span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $row)
                                    <tr>
                                        <td><img src="{{asset('uploads/products/'.$row->products->image)}}" alt="" width="50px" height="50px"></td>
                                        <td>{{ $row->products->name}}</td>
                                        <td>{{ $row->product_qty}}</td>
                                        <td>{{ $row->products->selling_price*$row->product_qty}}</td>
                                    </tr>
                                    <input type="hidden" name="total_price" value="{{ $row->products->selling_price*$row->product_qty }}">
                                    @endforeach
                                </tbody>
                            </table> 
                            <hr>
                            <input type="hidden" name="payment_mode" value="COD">
                           
                            <button class="btn btn-success form-control">Place Order | COD</button>
                            <button type="button" class="btn btn-primary w-100 mt-3" id="razorpay">Pay with Razorpay</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</form>
</div>
@endsection