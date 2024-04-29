<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductsModel;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $product_id = $request->post('product_id');
        $quanity = $request->post('quanity');
        if(Auth::check())
        {
           $product = ProductsModel::where('id', $product_id)->first();
           if($product)
           {
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(['status'=>"Already Added To Cart"]);
                }else{
                    $cart = new Cart();
                    $cart->product_id = $product_id;
                    $cart->user_id = Auth::id();
                    $cart->product_qty = $quanity;
                    $cart->save();
                    return response()->json(['status'=>$product->name."Added To Cart"]);
                }
           }
        }else{
            return response()->json(['status'=>"Login to continue"]);
        }
    }

    public function cart_list()
    {
        $cart = Cart::where('user_id',Auth::id())->get();
        return view('frontend.products.cart',compact('cart'));
    }

    public function remove_cart_item(Request $request) 
    {
        if(Auth::check())
        {
            $product_id = $request->post('product_id');
            
            if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status'=>"Removed Successfully from cart"]);
            }
        }else{
            return response()->json(['status'=>"Login to continue"]);
        } 
    }

    public function cart_update(Request $request)
    {
        $product_id = $request->post('product_id');
        $quanity = $request->post('quanity');
        if(Auth::check())
        { 
            if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->product_qty=$quanity;
                $cartItem->update();
                return response()->json(['status'=>"Quantity Successfully Updated"]);
            }
        }else{
            return response()->json(['status'=>"Login to continue"]);
        } 
    }
}
