<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function save_reviews(Request $request)
    {
        $reviews = new Reviews;
        $reviews->user_id = Auth::id();
        $reviews->product_id = $request->post('product_id');
        $reviews->message = $request->post('review');
        $reviews->save();
        
        return response()->json(['status'=>'200','message'=>'Review Added Successfully']);  
    }

    public function get_reviews()
    {
        $reviews = Reviews::where('user_id', Auth::id())->get();
        if(count($reviews)>0)
        {
            return response()->json(['status'=>'200','data'=>$reviews]);  
        } 
    }

    public function update_review(Request $request)
    {
        $review_id = $request->post('review_id');
       
        $reviews = Reviews::find($review_id);
        $reviews->message = $request->post('review_msg');
        $reviews->update();
        return response()->json(['status'=>'200','message'=>'Review Updated successfully']); 
    }
}
