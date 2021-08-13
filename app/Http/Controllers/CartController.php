<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class CartController extends Controller
{
    function cart(Request $request, $slug = '' ){
        if($slug == ''){
            // Discount and discount type variable gulo initailize kora hoichy cart page a jeno error na ase tai akhane variable gulo cart page a sent kora hoichy.
            $discountAmount = 0;
            $discountType = null;
            $minAmount = 0;
            $oldCookie_id = $request->cookie('cookie_id');
            $carts = Cart::with(['Product','Color', 'Size'])->where('cookie_id', $oldCookie_id )->get();
            return view('Frontend.pages.cart', [
                'carts' => $carts,
                'discountAmount' => $discountAmount,
                'discountType' => $discountType,
                'minAmount' => $minAmount,
            ]);
        }else{
            $couponCheck = Coupon::where('coupon_code', $slug);

            // Coupon Achy kina Check kora hoichy
            if($couponCheck->exists()){
                $currentDate = Carbon::now()->format('Y-m-d');
                $coupon = Coupon::where('coupon_code', $slug)->first();

                // Coupon er Expied Date Check kora hoichy.
                if($currentDate <= $coupon->ending_time ){
                    $discount = $coupon->discount_amount;
                    $discountType = $coupon->discount_type;
                    $minAmount = $coupon->min_amount;
                    $oldCookie_id = $request->cookie('cookie_id');
                    $carts = Cart::where('cookie_id', $oldCookie_id )->get();

                    // Session er moddy Coupon Code Rakha hoyechy Checkout Page a coupon data neyar jonno.
                    session(['coupon' => $slug ]);
                    return view('Frontend.pages.cart', [
                        'carts' => $carts,
                        'discountAmount' => $discount,
                        'discountType' => $discountType,
                        'minAmount' => $minAmount
                    ]);
                }else{
                    return back()->with('message', 'Coupon Code Expired');
                }
            }else{
                return back()->with('message', 'Invalid Coupon Code');
            }

        }

    }

    function singleCart($slug, Request $request ){
        $oldCookie_id = $request->cookie('cookie_id');
        if($oldCookie_id){
            $cookie_id = $oldCookie_id;
        }else{
            $minutes = 48900;
            $cookie_id = Str::random(10);
            Cookie::queue( 'cookie_id', $cookie_id, $minutes );
        }

        $product_id = Product::where('slug', $slug)->first()->id;
        $carts = Cart::where('product_id', $product_id )->where('cookie_id', $cookie_id);
        if($carts->exists()){
            $carts->increment('quantity');

            $carts->save();
            $notification = array(
                'message' => 'Cart Updated Successfully',
                'alert-type' => 'success'
            );
            // Toastr Alert
            return back()->with($notification);
        }else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->product_id = $product_id;
            $cart->save();

            $notification = array(
                'message' => 'Add to cart product successfully',
                'alert-type' => 'success'
            );
            // Toastr Alert
            return back()->with($notification);
        }
    }

    function productCart(Request $request){
        $request->validate([
            'color' => ['required'],
            'size' => ['required'],
        ],[
            'color.required' => 'Please Select Product Color',
            'size.required' => 'Please Select Product Size'
        ]);

        $oldCookie_id = $request->cookie('cookie_id');
        if($oldCookie_id){
            $cookie_id = $oldCookie_id;
        }else{
            $minutes = 48900;
            $cookie_id = Str::random(10);
            Cookie::queue( 'cookie_id', $cookie_id, $minutes );
        }
        $product_id = Product::findOrFail($request->product_id)->id;
        $carts = Cart::where('product_id', $product_id )->where('cookie_id', $cookie_id)->where('color_id', $request->color )->where('size_id', $request->size);
        if($carts->exists()){
            $carts->increment('quantity', $request->quantity);
            $notification = array(
                'message' => 'Cart Update successfully',
                'alert-type' => 'success'
            );
            // Toastr Alert
            return back()->with($notification);
        }else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->product_id = $product_id;
            $cart->color_id = $request->color;
            $cart->size_id = $request->size;
            $cart->quantity = $request->quantity;
            $cart->save();

            $notification = array(
                'message' => 'Add to cart product successfully',
                'alert-type' => 'success'
            );
            // Toastr Alert
            return back()->with($notification);
        }
    }

    // Cart Update Using HTML FROM.
    function cartUpdate(Request $request){
        // return $request->all();
        // Update Function Jokhon Use korbo tokhon Model ke protected $fillable use kore fill gulo ke likhte dite hobe.
        foreach ($request->cart_id as $key => $cart) {
            Cart::findOrFail($cart)->update([
                'quantity' => $request->quantity[$key]
            ]);
        }

        $notification = array(
            'message' => 'Cart Update successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }

    // Cart Update Using Ajax.
    function cartUpdateAjax(Request $request){
        Cart::findOrFail($request->id)->update([
            // qty cames from ajax data also id.
            'quantity' => $request->qty
        ]);
    }

    //Cart Delete
    function cartDelet($id){
        Cart::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Cart Product Delete Successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }

    // public function wishlistToCart(Request $request){
    //     $oldCookie_id = $request->cookie('cookie_id');
    //     if($oldCookie_id){
    //         $cookie_id = $oldCookie_id;
    //     }else{
    //         $minutes = 48900;
    //         $cookie_id = Str::random(10);
    //         Cookie::queue( 'cookie_id', $cookie_id, $minutes );
    //     }

    //     $userId = Auth::id();
    //     $wishlists = Wishlist::where('product_id', $request->product_id)->where('user_id', $userId);
    //     // $product_id = Product::findOrFail($request->product_id)->id;
    //     $carts = Cart::where('product_id', $request->product_id )->where('cookie_id', $cookie_id)->where('color_id', $request->color_id )->where('size_id', $request->size_id);
    //     if($carts->exists()){
    //         $carts->increment('quantity', $request->quantity);
    //         $wishlists->delete();
    //         return response()->json([
    //             'success' => 'Cart Product Updated.',
    //         ]);
    //     }else{
    //         $cart = new Cart;
    //         $cart->cookie_id = $cookie_id;
    //         $cart->product_id = $request->product_id;
    //         $cart->color_id = $request->color_id;
    //         $cart->size_id = $request->size_id;
    //         $cart->quantity = $request->quantity;
    //         $cart->save();
    //         $wishlists->delete();
    //         return response()->json([
    //             'success' => 'Add to cart product successfully.',
    //         ]);

    //     }
    // }



}
