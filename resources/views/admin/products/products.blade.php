@extends('layouts.master')
@section('title', "Admin | Products")
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Products</h1>
    @if (session('status'))
     <div class="alert alert-success">{{ session('status') }}</div>
    @endif
   
        <div class="card">
            <div class="card-header">Products  
                <a href="{{  url('/admin/add-products') }}" class="btn btn-success float-end" >Add Product</a>
            </div>
            <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Selling price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $row)
                    <tr>
                        <th scope="row">{{ $row->id }}</th>
                        <td>{{ $row->category->name }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->selling_price }}</td>
                        <td>{{ $row->description }}</td>
                        <td><img src="{{ asset('uploads/products/'.$row->image) }}" width="200px" height="100px"></td>
                        <td>
                          <a href="{{ url('/admin/get_categoryId/'.$row->id) }}" class="btn btn-success">Edit</a>
                          <a href="{{ url('/admin/delete-category/'.$row->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>   
</div>
@endsection