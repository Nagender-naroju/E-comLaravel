@extends('layouts.master')
@section('title', "Admin | Categories")
@section('content')
<div class="container-fluid px-4">
 
    <div class="card mt-4">
     <div class="card-header"><h4>Add Category</h4></div>
     <div class="card-body">

     @if ($errors->any())
         <div class="alert alert-danger">
            @foreach ($errors->all() as $row)
                <div>{{ $row }}</div>
            @endforeach
         </div>
     @endif
        <form action="{{ url('/admin/save-category') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="category_name">Category Name</label>
              <input type="text" name="category_name" class="form-control">
            </div>
            <div class="mb-3">
              <label for="slug">Slug</label>
              <input type="text" name="slug" class="form-control">
            </div>
            <div class="mb-3">
              <label for="description">Description</label>
              <textarea name="description" id="description" class="form-control"  rows="5"></textarea>
            </div>
            <div class="mb-3">
              <label for="cat_image">Image</label>
              <input type="file" name="cat_image" class="form-control">
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
                  <label for="navbar_status">Navbar Status</label>
                  <input type="checkbox" name="navbar_status">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="status">Status</label>
                  <input type="checkbox" name="status">
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