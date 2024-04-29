@extends('layouts.master')
@section('title', "Admin | Categories")
@section('content')
<div class="container-fluid px-4">
 
    <div class="card mt-4">
     <div class="card-header"><h4>Edit Category</h4></div>
     <div class="card-body">

     @if ($errors->any())
         <div class="alert alert-danger">
            @foreach ($errors->all() as $row)
                <div>{{ $row }}</div>
            @endforeach
         </div>
     @endif
        <form action="{{ url('/admin/update_category/'.$category->id )}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="category_name">Category Name</label>
              <input type="text" name="category_name" value="{{$category->name}}" class="form-control">
            </div>
            <div class="mb-3">
              <label for="slug">Slug</label>
              <input type="text" name="slug" value="{{$category->slug}}" class="form-control">
            </div>
            <div class="mb-3">
              <label for="description">Description</label>
              <textarea name="description" id="description" class="form-control"  rows="5">{{$category->description}}</textarea>
            </div>
            @if ($category->image)
                <img src="{{asset('uploads/category/'.$category->image )}}" width="100px" height="100px">
            @endif
            <div class="mb-3">
              <label for="cat_image">Image</label>
              <input type="file" name="cat_image" class="form-control">
              <input type="hidden" name="old_image" class="form-control" value="{{$category->image}}">
            </div>
            <h6>SEO TAGS</h6>
            <hr>
            <div class="mb-3">
              <label for="meta_title">Meta Title</label>
              <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control">
            </div>
            <div class="mb-3">
              <label for="meta_description">Meta Description</label>
              <textarea name="meta_description" id="meta_description" value="" class="form-control"  rows="5">{{$category->meta_description }}</textarea>
            </div>
            <div class="mb-3">
              <label for="meta_keywords">Meta Keywords</label>
              <textarea name="meta_keywords" id="meta_keywords" value="" class="form-control"  rows="5">{{$category->meta_keyword }}</textarea>
            </div>
            <h6>STATUS MODE</h6>
            <hr>
            <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="navbar_status">Navbar Status</label>
                  <input type="checkbox" name="navbar_status" {{$category->navbar_status == '1' ? 'checked': ''}}>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="status">Status</label>
                  <input type="checkbox" name="status" {{$category->status == '1' ? 'checked': ''}}>
                </div>
                <div class="col-md-6 mb-3">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
     </div>
    </div>
 
</div>
@endsection