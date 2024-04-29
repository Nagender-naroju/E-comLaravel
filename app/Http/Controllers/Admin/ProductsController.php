<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductsModel;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
   public function products_list()
   {
      $products = ProductsModel::all();
      
      return view('admin.products.products', compact('products'));
   }

   public function add_product()
   {
    $categories = Categories::all();
    return view('admin.products.addProduct',compact('categories'));
   }

   public function store_product(Request $request)
   {
      $product = new ProductsModel();
      if($request->hasfile('pro_image'))
        {
            $file = $request->file('pro_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/products', $filename);
            $product->image = $filename;
        }

        $product->name = $request->input('product_name');
        $product->category_id = $request->input('category_id');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->tax = $request->input('tax');
        $product->qty = $request->input('qty');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->status = $request->input('status')==TRUE ? '1':'0';
        $product->trending = $request->input('trending')==TRUE ? '1':'0';
        $product->save();
        return redirect('admin/products')->with('status', 'Product Added Successfully');
   }
}
