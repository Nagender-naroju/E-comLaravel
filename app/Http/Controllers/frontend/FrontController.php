<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductsModel;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\Order_items;
use App\Models\Reviews;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $trending_products = ProductsModel::where('trending', '1')->take(15)->get();
        $categories = Categories::where('status', '1')->get();
        return view('frontend.index', compact('trending_products','categories'));
    }

    public function fetch_categories()
    {
        $categories = Categories::where('status', '1')->get();
        return view('frontend.categories',compact('categories'));
    }

    public function view_categories($slug){
      if(Categories::where('slug',$slug)->exists())
      {
        $category = Categories::where('slug',$slug)->first();
        $products = ProductsModel::where('category_id', $category->id)->where('status', '0')->get();
        
        
        return view('frontend.products.index',compact('category','products'));
      }else{
        return redirect('/')->with('status', 'Slug not found');
      }
    }

    public function view_product($id)
    {
        $products = ProductsModel::where('id', $id)->where('status', '0')->get();
        foreach($products as $row)
        {
            $count =  Wishlist::where('user_id', Auth::id())->where('product_id',$row['id'])->get();
            $is_sold =  Order_items::join('orders', 'orders.id','=','Order_items.order_id') 
                                    ->join('products', 'products.id','=','Order_items.product_id') 
                                    ->where('orders.user_id',Auth::id())
                                    ->where('Order_items.product_id',$row['id'])
                                    ->count();
            $is_review = Reviews::where('user_id',Auth::id())->where('product_id',$row['id'])->count();
           
            $row['is_sold'] =  $is_sold;
            $row['is_review'] =  $is_review;
            $row['is_added'] = count($count);
        }
        
        $products_name = ProductsModel::where('id', $id)->where('status', '0')->first();
        return view('frontend.products.product_view',compact('products','products_name'));
    }


    public function add_wishlist(Request $request)
    {
      if(Auth::check())
      {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('product_id',$request->post('product_id'))->get();
        if(count($wishlist) == 1)
        {
            // remove
            $list = Wishlist::where('user_id', Auth::id())->where('product_id',$request->post('product_id'))->first();
            $list->delete();
          echo json_encode(['status'=>'Removed Successfully']);
        }else{
            // add
            $list = new Wishlist();
            $list->user_id = Auth::id();
            $list->product_id = $request->post('product_id');
            $list->save();
            echo json_encode(['status'=>'Added Successfully']);
        }
      }else{
        return response()->json(['status'=>"Login to continue"]);
      }
    }

    public function wishlist_page()
    {
      return view('frontend.wishlists');
    }
    public function get_wishlists()
    {
      if(Auth::check())
      {
        // $wishlists = Wishlist::where('user_id', Auth::id())->get();
         $wishlists = Wishlist::join('users', 'users.id', '=', 'wishlist.user_id')
                              ->join('products','products.id','=','wishlist.product_id')
                              ->select('users.name', 'products.*')
                              ->where('wishlist.user_id',Auth::id())
                              ->get();
        return response()->json(['status'=>"200", 'data'=> $wishlists]);
      }else{
          return response()->json(['status'=>"Login to continue"]);
      }
    }

    public function get_wishlist_count()
    {
      $wish_count = Wishlist::where('user_id', Auth::id())->get();
      return response()->json(['status'=>"200", 'data'=> $wish_count]);
    }

    public function get_cart_count()
    {
      $cart_count = Cart::where('user_id', Auth::id())->get();
      return response()->json(['status'=>"200", 'data'=> $cart_count]);
    }


    public function search_product(Request $request)
    {
      $search_name = $request->post('search_product');
      $search_data = ProductsModel::where('name', 'like', '%' . $search_name . '%')->first();
      if($search_data){
        return redirect('/view-product'.'/'.$search_data->id);
      }else{
        return redirect()->back()->with('status','No products matched to your search');
      }
    }

    public function get_products()
    {
      $products = ProductsModel::select('name')->where('status','0')->get();
      $data = [];
      foreach($products as $row)
      {
        $data[] = $row['name'];
      }
      return  $data;
    }
}
