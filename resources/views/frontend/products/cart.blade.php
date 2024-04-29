@extends('layouts.front')

@section('title')
 My Cart
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sw bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 " >Collections / <a href=""></a> / </h6>
    </div>
</div>
    <div class="container"> 
        <div class="card shadow ">
            <div class="card-header bg-info" style="color:aliceblue">My Cart</div>
            <div class="card-body">
                @php
                    $total=0;
                @endphp
                @if (count($cart)>0)
                    @foreach ($cart as $row)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{asset('uploads/products/'.$row->products->image)}}" alt="" width="200px" height="100px">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h4>{{ $row->products->name }}</h4>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h4>Rs : {{ $row->products->selling_price }}</h4>
                            </div>
                            <div class="col-md-3 my-auto">
                                @if ($row->products->qty>$row->product_qty)
                                    <label for="quantity">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <button class="input-group-text changeQty" id="decrement">-</button>
                                            <input type="text" name="quanity" id="quanity" value="{{$row->product_qty}}" class="form-control " />
                                            <input type="hidden" name="quanity" id="product_id" value="{{$row->product_id}}" class="form-control " />
                                        <button class="input-group-text changeQty" id="increment">+</button>
                                    </div>
                                    @else
                                    <h6>Out Of Stock</h6>
                                @endif
                                @php 
                                    $total +=  $row->products->selling_price*$row->product_qty;
                                @endphp   
                            </div>
                            <div class="col-md-2 my-auto">
                                <a  class="btn btn-danger" id="remove_cart" data-proid="{{ $row->product_id }}">Remove</a>
                            </div>
                        </div>  
                    @endforeach
                @else
                  <img style="margin-left: 337px;" src="{{asset('/uploads/empty-cart-yellow.png')}}"  width="350px" alt="">
                @endif
            </div>
            @if (count($cart)>0)
            <div class="card-footer">
                <h6>Total Price : Rs {{ $total }}
                  <a href="{{ url('/checkout') }}" class="btn btn-success float-end">Proceed To Checkout</a>
                </h6>
            </div>
            @endif
        </div>
    </div>
@endsection
