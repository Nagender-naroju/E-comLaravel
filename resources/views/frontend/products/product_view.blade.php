@extends('layouts.front')

@section('title')
 Welcome to  Eshop
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sw bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 " >Collections / <a href="{{url('/view-category/'.$products_name->category->name)}}">{{ $products_name->category->name }}</a> / {{ $products_name->name }}</h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h1>{{ $products_name->name }}  <a href="{{url('/view-category/'.$products_name->category->name)}}" class="float-end"> <i class="fa-solid fa-backward"></i></a></h1>
           
                @foreach ($products as $row)
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wish ">
                                    @if ($row->is_added==1)
                                        <a title="Remove" href="#" class="float-end" id="add" data-id="{{ $row->id }}"><img src="{{asset('uploads/heart.png')}}" width="35px" height="35px"></a>
                                    @else
                                       <a title="Add" href="#" class="float-end" id="add" data-id="{{ $row->id }}">  <img src="{{asset('uploads/nofill.png')}}"  width="35px" height="35px"></a>
                                    @endif
                                </div>
                              <img src="{{ asset('uploads/products/'.$row->image)}}" width="500px">   
                            </div>
                            <div class="col-md-6">
                                <h2>
                                {{ $row->name }} 
                                @if ($row->trending == 1)
                                 <label style="font-size:16px" class="badge bg-danger float-end">Trending</label>
                                @else
                                 <label class="badge bg-danger"></label>
                                @endif
                                
                                </h2>
                                <hr>
                                <b><span class="float-start">Selling Price : Rs {{ $row->selling_price }}</span></b>
                                <span > &nbsp;&nbsp; Selling Price : <s>Rs{{ $row->original_price }}</s></span>

                                <p class="mt-3">{{ $row->small_description }}</p>
                                <hr>
                                @if ($row->qty > 0)
                                    <label class="badge bg-success">In stock</label>
                                @else
                                   <label class="badge bg-success">Out of stock</label>
                                @endif

                                <div class="row mt-2">
                                    <div class="col-md-3">
                                      <label for="quantity">Quantity</label>
                                      <div class="input-group text-center mb-3">
                                        <button class="input-group-text" id="decrement">-</button>
                                        <input type="text" name="quanity" id="quanity" value="1" class="form-control " />
                                        <button class="input-group-text" id="increment">+</button>
                                      </div>
                                    </div>
                                    <div class="col-md-9">
                                    </br>
                                        @if ($row->qty > 0)
                                        <button type="button" class="btn btn-danger me-3 float-start" data-proid="{{ $row->id }}" id="add_cart">Add to cart <i class="fa-solid fa-cart-shopping"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <h5>Description</h5>
                            <p class="mt-3">{{ $row->description }}</p>
                            </div>
                        </div>
                        <hr>
                        @if ($row->is_review > 0)
                            <div class="reviews-data">

                            </div>
                           @elseif ($row->is_review > 0  || $row->is_sold==1)
                           <button class="btn btn-primary openclose">Add Review</button>
                            <div class="mt-2">
                                <form method="post" id="content" class="d-none">
                                    @csrf
                                    <div class="mt-2">
                                      <textarea name="review" id="review" cols="50" rows="10" required></textarea>
                                      <input type="hidden" name="prod_id" id="prod_id" value="{{ $row->id }}"> 
                                    </div>
                                    <div class="mt-2">
                                      <input type="submit"  class="btn btn-success add_review" value="Add">
                                    </div>     
                                </form>
                            </div>
                        @endif  
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
 $(document).ready(function(){
    $(".openclose").click(function(){
    var check=$(".openclose").text().trim();
        if(check=="Close"){
            $(".openclose").text("Add Review");
            $("#content").addClass("d-none");
        }else{
            $(".openclose").text("Close");
            $("#content").removeClass("d-none");
        }
    });
 });
</script>
@endsection