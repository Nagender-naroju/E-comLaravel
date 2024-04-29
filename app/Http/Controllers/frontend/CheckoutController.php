<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductsModel;
use App\Models\Cart;
use App\Models\Order_items;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // $old_cart = Cart::where('user_id', Auth::id())->get();
        // foreach($old_cart as $row)
        // {
        //     if(!ProductsModel::where('id',$row->product_id)->where('qty','>=', $row->product_qty)->exists())
        //     {
        //         $remove = Cart::where('user_id', Auth::id())->where('product_id',$row->product_id)->first();
        //         $remove->delete();
        //     }
        // }
        $cart = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout',compact('cart'));
    }

    public function place_order(Request $request){
        $orders = new Orders();
        $orders->user_id = Auth::id();
        $orders->fname = $request->post('first_name');
        $orders->lname = $request->post('last_name');
        $orders->email = $request->post('email');
        $orders->phone = $request->post('mobile_number');
        $orders->address_1 = $request->post('address_1');
        $orders->address_2 = $request->post('address_2');
        $orders->country = $request->post('country');
        $orders->state = $request->post('state');
        $orders->city = $request->post('city');
        $orders->pincode = $request->post('pin_code');
        $orders->tracking_no = "ORD".rand(10000,99999);
        $orders->payment_mode= $request->post('payment_mode');
        
        if($request->post('payment_mode')=="COD")
        {
           
            $orders->payment_id = "ORD".rand(10000,99999);
        }else{
            $orders->payment_id = $request->post('payment_id');
        }
        
        $orders->total_price = $request->post('total_price');
        $orders->save();
        $orders->id;
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems as $row)
        {
            Order_items::create([
                'order_id'=>$orders->id,
                'product_id'=>$row->product_id,
                'qty'=>$row->product_qty,
                'price'=>$row->products->selling_price,
            ]);
            $prod = ProductsModel::where('id', $row->product_id)->first();
            $prod->qty =   $prod->qty - $row->product_qty;
            $prod->update();
        }

        if(Auth::user()->address_1==NULL)
        {
          $users = User::where('id', Auth::id())->first();
          $users->name = $request->post('first_name');
          $users->lname = $request->post('last_name');
          $users->email = $request->post('email');
          $users->address_1 = $request->post('address_1');
          $users->address_2 = $request->post('address_2');
          $users->country = $request->post('country');
          $users->state = $request->post('state');
          $users->city = $request->post('city');
          $users->pincode = $request->post('pin_code');
          $users->update();
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);
        if($request->post('payment_mode')=='Paid by Razorpay')
        {
            return response()->json(['status'=>'Order Placed Successfully']);
        }
        return redirect('/view-cart')->with('status',"Order Placed Successfully");
    }

    public function my_orders(){
        $users = Orders::where('user_id', Auth::id())->get();
        $orders = [];
        foreach($users as $row)
        {
            $orders[] = Order_items::where('order_id',$row->id)->get();
        }

        return view('frontend.orders',compact('users','orders'));
    }

    public function view_orders(Request $request, $id)
    {
        $user = Orders::where('user_id', Auth::id())->first();
        $user_ordres = Orders::where('user_id', Auth::id())->get();
        $orders = [];
        foreach($user_ordres as $row)
        {
            $orders[] = Order_items::where('order_id',$row->id)->get();
        }
        return view('frontend.view_orders',compact('user','orders'));
    }

    public function razorpay_payment(Request $request)
    {
           $cartItems = Cart::where('user_id', Auth::id())->get();
           $total = 0;
           foreach($cartItems as $row){
               $total += $row->products->selling_price*$row->product_qty;
           }
            $first_name = $request->post('first_name');
            $last_name = $request->post('last_name');
            $email = $request->post('email');
            $mobile_number = $request->post('mobile_number');
            $address_1 = $request->post('address_1');
            $address_2 = $request->post('address_2');
            $country = $request->post('country');
            $state = $request->post('state');
            $city = $request->post('city');
            $pin_code = $request->post('pin_code');

            return response()->json([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'mobile_number' => $mobile_number,
                'address_1' => $address_1,
                'address_2' => $address_2,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'pin_code' => $pin_code,
                'total' => $total,
            ]);
    }
}
