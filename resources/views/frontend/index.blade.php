@extends('layouts.front')

@section('title')
 Welcome to  Eshop
@endsection

@section('content')
@include('inc.slider')
<div class="py-5">
    <div class="container">
        <div class="row">
            <h1>Featured Products</h1>
            <div class="owl-carousel owl-theme">
                @foreach ($trending_products as $row)
                    <div class="item">
                        <div class="card shadow mt-3">
                            <img src="{{ asset('uploads/products/'.$row->image)}}">
                            <div class="card-body">
                                <h5>{{ $row->name }}</h5>
                                <span class="float-start">{{ $row->selling_price }}</span>
                                <span class="float-end"><s>{{ $row->original_price }}</s></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <h1>All Categories</h1>
            <div class="owl-carousel owl-theme">
                @foreach ($categories as $row)
                <a href="{{ url('view-category/'.$row->slug)}}">
                    <div class="item">
                        <div class="card shadow mt-3">
                            <img src="{{ asset('uploads/category/'.$row->image)}}">
                            <div class="card-body">
                                <h5>{{ $row->name }}</h5>
                                <span class="float-start">{{ $row->description }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection