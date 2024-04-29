@extends('layouts.front')

@section('title')
 Checkout
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sw bg-warning border-top">
    <div class="container">
        <h6 class="mb-0 " >Collections / Wishlist </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="card">
            <div class="card-header bg-info" style="color:aliceblue">Wishlist</div>
            <div class="card-body" id="wish_data">
               
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        getWhihlist()
        function getWhihlist()
        {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/wishlists') }}",
                method:"get",
                dataType:"json",
                success:function(response)
                {
                    var html = "";
                   if(response.data.length>0)
                   {
                    url = "http://127.0.0.1:8000/uploads/products/";
                    for(var i=0; i<response.data.length; i++)
                    {
                        if(response.data[i].trending==1)
                        {
                            var trend = '<label style="font-size:16px" class="badge bg-danger float-end">Trending</label>'        
                        }else{
                            var trend = '<label class="badge bg-danger"></label>'
                        }

                        html += "<div class='row'>"
                        html += "<div class='col-md-6'>"
                        html += "<img src='"+url+response.data[i].image+"' width='500px'>"
                        html += "</div>"
                        html += "<div class='col-md-6'>"
                        html += "<h2>"+response.data[i].name+" "+trend+"</h2><hr>"
                        html += "<b><span class='float-start'>Selling Price : Rs "+response.data[i].selling_price+"</span></b>"
                        html += "<span > &nbsp;&nbsp; Original Price : <s>Rs"+response.data[i].original_price+"</s></span>"
                        html += "<p class='mt-3'>"+response.data[i].small_description+"</p>"
                        html += "<hr>"
                        html += "</div>"
                        html += "</div>"
                        html += "<hr>"
                    }
                   }else{
                       html += "<img style='margin-left: 337px;' src='http://127.0.0.1:8000/uploads/emptywishlist.png'  width='350px'>"
                   }
                 
                 
                  $('#wish_data').html(html)
                }
            })
        }
    })
</script>
@endsection