@extends('layouts.front')

@section('title')
 My Orders
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sw bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 " >Collections / My Orders</h6>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-header bg-info">Orders</div>
        <div class="card-body">
        @if (count($orders)>0)
            <table  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <!-- <th>User Name</th> -->
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $userOrders)
                        @foreach ($userOrders as $row)
                            <tr>
                            <td><img src="{{asset('uploads/products/'.$row->products->image)}}" alt="" width="200px"></td>
                                <td>{{ $row->products->name }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>Rs : {{ $row->products->selling_price*$row->qty }}</td>
                                <td><a href="{{ url('view-orders/'.$row->id) }}" class="btn btn-success">view</a></td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="ml-3" style="text-align: center;">No Data Found</div>
        @endif        
        </div>
    </div>
</div>
@endsection