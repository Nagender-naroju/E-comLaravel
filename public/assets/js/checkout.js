$(document).ready(function(){
    $(document).on('click', '#razorpay', function(e){
        e.preventDefault;
        var first_name = $('.first_name').val();
        var last_name = $('.last_name').val();
        var email = $('.email').val();
        var mobile_number = $('.mobile_number').val();
        var address_1 = $('.address_1').val();
        var address_2 = $('.address_2').val();
        var country = $('.country').val();
        var state = $('.state').val();
        var city = $('.city').val();
        var pin_code = $('.pin_code').val();

        if(!first_name){
            fname_error = "First Name is required"
            $('#first_error').html('')
            $('#first_error').html(fname_error)
        }else{
            fname_error = "";
            $('#first_error').html('')
        }

        if(!last_name){
            last_error = "Last Name is required"
            $('#last_error').html('')
            $('#last_error').html(last_error)
        }else{
            last_error = "";
            $('#last_error').html('')
        }
        if(!email){
            email = "Email is required"
            $('#email').html('')
            $('#email').html(email)
        }else{
            email = "";
            $('#email').html('')
        }
        if(!mobile_number){
            number = "Mobile number is required"
            $('#number').html('')
            $('#number').html(number)
        }else{
            email = "";
            $('#number').html('')
        }
        if(!address_1){
            address_1 = "Address 1 is required"
            $('#address_1').html('')
            $('#address_1').html(address_1)
        }else{
            address_1 = "";
            $('#address_1').html('')
        }
        if(!address_2){
            address_2 = "Address 2 is required"
            $('#address_2').html('')
            $('#address_2').html(address_2)
        }else{
            address_2 = "";
            $('#address_2').html('')
        }
        if(!country){
            country = "Country is required"
            $('#country').html('')
            $('#country').html(country)
        }else{
            country = "";
            $('#country').html('')
        }
        if(!state){
            state = "State is required"
            $('#state').html('')
            $('#state').html(state)
        }else{
            state = "";
            $('#state').html('')
        }
        if(!city){
            city = "City is required"
            $('#city').html('')
            $('#city').html(city)
        }else{
            city = "";
            $('#city').html('')
        }

        if(!pin_code){
            pin_code = "Pincode is required"
            $('#pinCode').html('')
            $('#pinCode').html(pin_code)
        }else{
            pin_code = "";
            $('#pinCode').html('')
        }

        if(fname_error != "" || last_error != ""){
              return false;
        }else{
           var data = {
            'first_name': first_name,
            'last_name' :last_name,
            'email' : email,
            'mobile_number' : mobile_number,
            'address_1' : address_1,
            'address_2' :address_2,
            'country' :country,
            'state' :state,
            'city' :city,
            'pin_code' :pin_code
           }

           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method:"POST",
            url:"/proceed-pay",
            data: data,
            success:function(response)
            {
                var options = {
                    "key": "rzp_test_h80KceRLj8V9wq", // Enter the Key ID generated from the Dashboard
                    "amount": 1*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": response.first_name+" "+response.last_name, //your business name
                    "description": "Thank you for choosing us.",
                    "image": "https://example.com/your_logo",
                    // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response){
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method:"POST",
                            url:"/proceed-pay",
                            data: {
                                'fname':response.first_name,
                                'lname':response.last_name,
                                'email':response.email,
                                'phone':response.mobile_number,
                                'address_1':response.address_1,
                                'address_2':response.address_2,
                                'country':response.country,
                                'state':response.state,
                                'city':response.city,
                                'pincode':response.pin_code,
                                'payment_mode':"Paid by Razorpay",
                                'payment_id':response.razorpay_payment_id
                            },
                            dataType:'json',
                            success:function(response)
                            {
                                alert(response.status)
                            }
                        })
                    },
                    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                        "name": response.first_name+" "+response.last_name, //your customer's name
                        "email": response.email,
                        "contact": response.mobile_number //Provide the customer's phone number for better conversion rates 
                    },
                    "notes": {
                        "address": "Razorpay Corporate Office"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                 rzp1.open();
            }
           })
        }
    })
})