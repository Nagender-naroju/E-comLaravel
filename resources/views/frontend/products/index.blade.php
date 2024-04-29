@extends('layouts.front')

@section('title')
 Welcome to {{ $category->name }}
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sw bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 " >Collections / {{ $category->name }} </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h1>{{ $category->name }}</h1>
                @foreach ($products as $row)
                    <div class="col-md-3">
                        <a href="{{ url('/view-product/'.$row->id) }}">
                            <div class="card shadow mt-3">
                                <img src="{{ asset('uploads/products/'.$row->image)}}" />
                                
                                <div class="card-body">
                                    <h5>{{ $row->name }}</h5>
                                    <span class="float-start">{{ $row->selling_price }}</span>
                                    <span class="float-end"><s>{{ $row->original_price }}</s></span>
                                </div>
                            </div>
                        </a>
                    </div>
                
                @endforeach
        </div>
    </div>
</div>
@endsection