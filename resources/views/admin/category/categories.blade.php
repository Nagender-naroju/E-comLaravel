@extends('layouts.master')
@section('title', "Admin | Categories")
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Categories</h1>
    @if (session('status'))
     <div class="alert alert-success">{{ session('status') }}</div>
    @endif
   
        <div class="card">
            <div class="card-header">Categories  
                <a href="{{  url('/admin/add-category') }}" class="btn btn-success float-end" >Add Category</a>
            </div>
            <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $row)
                    <tr>
                        <th scope="row">{{ $row->id }}</th>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->description }}</td>
                        <td><img src="{{ asset('uploads/category/'.$row->image) }}" width="100px" height="100px"></td>
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