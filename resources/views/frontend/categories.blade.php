@extends('layouts.front')

@section('title')
 Welcome to  Eshop
@endsection

@section('content')
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
                               <small>{{ $row->description }}</small>
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
            items:2
        }
    }
})
</script>
@endsection