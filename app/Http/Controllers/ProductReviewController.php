<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;
use Auth;

class ProductReviewController extends Controller
{
    
    function productReview(Request $request)
    {
        $ratting = ProductReview::where('product_id', $request->product_id)->where('user_id', Auth::id())->count();
        if($ratting > 0){
            return 'Already submited your review.';
        }else{
            $request->validate([
                'review_provider_name' => 'required',
                'review_provider_email' => 'required',
                'massage' => 'required|max:400',
                'ratting' => 'required',
            ]);

             $productReveiw = new ProductReview;
             $productReveiw->user_id = Auth::id();
             $productReveiw->product_id = $request->product_id;
             $productReveiw->name = $request->review_provider_name;
             $productReveiw->email = $request->review_provider_email;
             $productReveiw->review = $request->massage;
             $productReveiw->ratting = $request->ratting;
             $productReveiw->save();

             $notification = array(
                 'message' => 'Review and ratting submited successfully.',
                 'alert-type' => 'success'
             );
             return back()->with($notification);
        }

    }

}
