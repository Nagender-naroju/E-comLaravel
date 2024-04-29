<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Categories::all();
        
      return view('admin.category.categories', compact('categories'));
    }

    public function create_category()
    {
        return view('admin.category.add_category');
    }

    public function store_category(CategoryRequest $request){
        $data = $request->validated();
        $category  = new Categories();
        $category->name = $data['category_name'];     
        $category->slug = $data['slug'];     
        $category->description = $data['description'];     
        if($request->hasfile('cat_image'))
        {
            $file = $request->file('cat_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/category', $filename);
            $category->image = $filename;
        }

        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keywords'];
        $category->navbar_status = $request->navbar_status == true ? '1':'0';
        $category->status = $request->status == true ? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->save();
        return redirect('/admin/category')->with('status', 'Category Added Successfully');
    }

    public function get_categoryId($category_id)
    {
      $category =  Categories::find($category_id);
      return view('admin.category.editCategory',compact('category'));
    }

    public function update_category(Request $request,$id){
        
        $category =  Categories::find($id);

        $category->name = $request->category_name;     
        $category->slug = $request->slug;     
        $category->description = $request->description;  
        if($request->hasfile('cat_image'))
        {
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('cat_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/category', $filename);
            $category->image = $filename;
        }else{
            $category->image = $request->post('old_image');
           
        }

        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keyword = $request->meta_keywords;
        $category->navbar_status = $request->navbar_status == true ? '1':'0';
        $category->status = $request->status == true ? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->update();
        return redirect('/admin/category')->with('status', 'Category Updated Successfully');
    }

    public function delete_category($id)
    {
        $category =  Categories::find($id);
        if($category->image){
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('/admin/category')->with('status', 'Category Deleted Successfully');
    }
}
