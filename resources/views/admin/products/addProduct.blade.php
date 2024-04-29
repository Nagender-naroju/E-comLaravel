@extends('layouts.master')
@section('title', "Admin | Categories")
@section('content')
<div class="container-fluid px-4">
 
    <div class="card mt-4">
     <div class="card-header"><h4>Add Product</h4></div>
     <div class="card-body">

     @if ($errors->any())
         <div class="alert alert-danger">
            @foreach ($errors->all() as $row)
                <div>{{ $row }}</div>
            @endforeach
         </div>
     @endif
        <form action="{{ url('/admin/save-products') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="product_name">Product Name</label>
              <input type="text" name="product_name" class="form-control">
            </div>
            <div class="mb-3">
              <label for="category_id">Select Category</label>
              <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $row)
                        <option value="{{$row->id}}">{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="original_price">Original Price</label>
                  <input type="number" name="original_price" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="selling_price">Selling Price</label>
                  <input type="number" name="selling_price" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="tax">Tax</label>
                  <input type="number" name="tax" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="qty">Quantity</label>
                  <input type="number" name="qty" class="form-control">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="small_description">Small Description</label>
              <input type="text" name="small_description" class="form-control">
            </div>
            <div class="mb-3">
              <label for="description">Description</label>
              <textarea name="description" id="description" class="form-control"  rows="5"></textarea>
            </div>
            <div class="mb-3">
              <label for="pro_image">Image</label>
              <input type="file" name="pro_image" class="form-control">
            </div>
            <h6>SEO TAGS</h6>
            <hr>
            <div class="mb-3">
              <label for="meta_title">Meta Title</label>
              <input type="text" name="meta_title" class="form-control">
            </div>
            <div class="mb-3">
              <label for="meta_description">Meta Description</label>
              <textarea name="meta_description" id="meta_description" class="form-control"  rows="5"></textarea>
            </div>
            <div class="mb-3">
              <label for="meta_keywords">Meta Keywords</label>
              <textarea name="meta_keywords" id="meta_keywords" class="form-control"  rows="5"></textarea>
            </div>
            <h6>STATUS MODE</h6>
            <hr>
            <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="status">Status</label>
                  <input type="checkbox" name="status">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="trending">Trending</label>
                  <input type="checkbox" name="trending">
                </div>
                <div class="col-md-6 mb-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
     </div>
    </div>
 
</div>
@endsection