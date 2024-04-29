<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    
    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   <style>
    a{
        text-decoration: none !important;
        color:black
    }
   
   </style>
</head>
<body class="sb-nav-fixed">
   @include('inc.frontnavbar')
    <div id="layoutSidenav_content">
        <main>  
            @yield('content')
        </main>
    </div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('assets/js/scripts.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/checkout.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var availableTags = [ ];
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"{{ url('/get-products') }}",
        method:"GET",
        dataType:"json",
        success:function(response)
        {  
          search_prod(response)
        }
    })
    function search_prod(data){ 
        $( "#search_product" ).autocomplete({
          source: data
        });
    }
   
  </script>
<script>
    $(document).ready(function(){
        wish_count()
        cart_count()
        reviews()
        function wish_count(){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/wishlists-count') }}",
                method:"get",
                dataType:"json",
                success:function(response)
                {
                    if(response.data.length>0)
                    {
                        $('.wish_count').html("<span class='badge bg-danger wish_count'>"+response.data.length+"</span>")
                    }else{
                        $('.wish_count').html("")
                    }
                
                }
            })
        }

        $(document).on('click','.add_review', function(e){
            e.preventDefault();
            var product_id = $('#prod_id').val();
            var review = $('#review').val();
            add_reviews(product_id,review)
         })

        function reviews()
        {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/reviews') }}",
                method:"POST",
                dataType:"json",
                success:function(response)
                {
                    html="";
                   for(var i=0;i<response.data.length; i++)
                   {
                    html += "<form class='review-form' >";
                    html += "<textarea class='review-textarea' cols='40' rows='5' >" + response.data[i].message + "</textarea>";
                    html += "<div class='mt-1'>"
                    html += "<button type='button' id='edit-review' class='btn btn-success' data-review-id='" + response.data[i].id + "'>Edit</button>";
                    html += "</div>"
                    html += "</form>";
                   }
                    $('.reviews-data').html(html)
                }
            })
        }

        function add_reviews(product_id,review)
        {
            if(product_id != "" || review != "")
           {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{ url('/save-review') }}",
                    method:"POST",
                    data:{product_id:product_id,review:review},
                    dataType:"json",
                    success:function(response)
                    {
                        alert(response.message)
                        reviews()
                        $('#review').val('')
                    }
                })
           }else{
            alert('Something went wrong')
           }
        }

        $(document).on('click','#edit-review', function(e){
            e.preventDefault();
            var review_id = $(this).attr('data-review-id')
            var review_msg = $('.review-textarea').val()

            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{ url('/update-review') }}",
                    method:"POST",
                    data:{review_id:review_id,review_msg:review_msg},
                    dataType:"json",
                    success:function(response)
                    {
                        alert(response.message)
                        reviews()
                        
                    }
                })
        })

        function cart_count(){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/cart-count') }}",
                method:"get",
                dataType:"json",
                success:function(response)
                {
                    if(response.data.length>0)
                    {
                        $('.cart_count').html("<span class='badge bg-danger wish_count'>"+response.data.length+"</span>")
                    }else{
                        $('.cart_count').html("")
                    }
                
                }
            })
        }

        $(document).on('click', '#increment', function(e){
            e.preventDefault;
            var quanity = $('#quanity').val();
            if(quanity<10){
                quanity++;
                $('#quanity').val(quanity);
            }
        })

        $(document).on('click', '#decrement', function(e){
            e.preventDefault;
            var decrement = $('#quanity').val();
            if(decrement>1){
                decrement--;
                $('#quanity').val(decrement);
            }
        })

        $('#add_cart').click(function(e){
            e.preventDefault
            var product_id = $(this).attr('data-proid')
            var quanity = $('#quanity').val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/add-cart') }}",
                method:"post",
                data:{product_id:product_id,quanity:quanity},
                dataType:"json",
                success:function(response)
                {
                 alert(response.status)
                 cart_count()
                }
            })
        })

        $(document).on('click', '#add', function(e){
            e.preventDefault;
           var product_id = $(this).attr('data-id');
           $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/add-wishlist') }}",
                method:"post",
                data:{product_id:product_id},
                dataType:"json",
                success:function(response)
                {
            
                 $( ".wish" ).load(window.location.href + " .wish" );
                 wish_count()
                }
            })
        })

        $(document).on('click', '#increment', function(e){
            e.preventDefault;
            
            var quanity = $(this).closest('.product_data').find('#quanity').val();

            if(quanity<10){
                quanity++;
                $(this).closest('.product_data').find('#quanity').val(quanity);
            }
        })

        $(document).on('click', '#decrement', function(e){
            e.preventDefault;
           var decrement = $(this).closest('.product_data').find('#quanity').val();
            if(decrement>1){
                decrement--;
                $(this).closest('.product_data').find('#quanity').val(decrement);
            }
        })

        $(document).on('click', '#remove_cart', function(e){
            e.preventDefault;
            
            var product_id = $(this).attr('data-proid')
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/remove-item') }}",
                method:"post",
                data:{product_id:product_id},
                dataType:"json",
                success:function(response)
                {
                  alert(response.status)
                  cart_count()
                }
            })
        })

        $(document).on('click', '.changeQty', function(e){
            e.preventDefault
            var product_id = $(this).closest('.product_data').find('#product_id').val();
            var quanity = $(this).closest('.product_data').find('#quanity').val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"{{ url('/update-cart') }}",
                method:"POST",
                data:{product_id:product_id,quanity:quanity},
                dataType:"json",
                success:function(response)
                {
                    alert(response.status)
                }
            })
        })
    })
</script>
@yield('scripts')
</body>
</html>