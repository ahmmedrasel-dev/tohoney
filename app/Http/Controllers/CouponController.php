<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon(){
        return view('backend.Coupon.coupon',[
            'coupons' => Coupon::orderBy('id', 'desc')->simplepaginate(),
            'count' => Coupon::count()
        ]);
    }

    function couponPost(Request $request){

        $request->validate([
            'coupon_code' => ['required','unique:coupons'],
            'starting_date' => ['required'],
            'ending_date' => ['required'],
            'discount_type' => ['required'],
            'discount_amount' => ['required'],
            'min_amount' => ['required']
        ],
        [
           'starting_date.required' => 'Please select start date.',
           'ending_date.required' => 'Please select end date.',
           'discount_type.required' => 'Please select discount type.'
        ]
    );

        $coupon = new Coupon;
        $coupon->name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->starting_time = $request->starting_date;
        $coupon->ending_time = $request->ending_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->min_amount = $request->min_amount;
        $coupon->save();
        return back()->with('success', 'Coupon Created Successfully.');
    }

    function couponEdit($couponId){
        return view('backend.Coupon.coupon-edit', [
            'coupons' => Coupon::findOrFail($couponId),
        ]);
    }

    function couponUpdated(Request $request)
    {
        $coupons = Coupon::findOrFail($request->coupun_id);
        $coupons->name = $request->coupon_name;
        $coupons->coupon_code = $request->coupon_code;
        $coupons->starting_time = $request->starting_date;
        $coupons->ending_time = $request->ending_date;
        $coupons->discount_type = $request->discount_type;
        $coupons->discount_amount = $request->discount_amount;
        $coupons->min_amount = $request->min_amount;
        $coupons->save();
        $notification = array(
            'message' => 'Coupons Updated Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    function couponDelete($id)
    {
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupons Deleted Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
