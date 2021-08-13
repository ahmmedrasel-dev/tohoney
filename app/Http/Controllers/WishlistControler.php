<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class WishlistControler extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    //  Add to Wishlist Product
    public function addToWishlist($productId){
        $userId = Auth::id();
        $wishlists = Wishlist::where('product_id', $productId)->where('user_id', $userId);

        if(Auth::check()){
            if($wishlists->exists()){
                return response()->json([
                    'error' => 'The Proudct Already Exists Wishlist.',
                ]);
            }else{
                $wishlist = new Wishlist;
                $wishlist->product_id = $productId;
                $wishlist->user_id = $userId;
                $wishlist->save();
                return response()->json([
                    'success' => 'The Proudct add to Wishlist.',
                ]);
            }
        }else{
            return response()->json([
                'error' => 'At first login your account.',
            ]);
        }
    }

    // View Wishlist Blade Page.
    public function wishlist(){
        return view('Frontend.pages.wishlist', [
            'wishlist' => Wishlist::where('user_id', Auth::id())->get(),
        ]);
    }

    // Add to Cart Product From Wishlist.
    public function wishlistToCart(Request $request){
        $request->validate([
            'color' => ['required'],
            'size' => ['required'],
        ],[
            'color.required' => 'Please Select Product Color',
            'size.required' => 'Please Select Product Size'
        ]);

        $userId = Auth::id();

        $oldCookie_id = $request->cookie('cookie_id');
        if($oldCookie_id){
            $cookie_id = $oldCookie_id;
        }else{
            $minutes = 48900;
            $cookie_id = Str::random(10);
            Cookie::queue( 'cookie_id', $cookie_id, $minutes );
        }
        $product_id = Product::findOrFail($request->productid)->id;
        $carts = Cart::where('product_id', $product_id )->where('cookie_id', $cookie_id)->where('color_id', $request->color )->where('size_id', $request->size);
        if($carts->exists()){
            $carts->increment('quantity', $request->quantity);
            return back()->with('success', 'Cart product Update successfully');
        }else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->product_id = $product_id;
            $cart->color_id = $request->color;
            $cart->size_id = $request->size;
            $cart->quantity = $request->quantity;
            $cart->save();
            Wishlist::findOrFail($request->wishlistid)->delete();

            $notification = array(
                'message' => 'Add to cart product successfully',
                'alert-type' => 'success'
            );
            // Toastr Alert
            return back()->with($notification);
        }
    }

    // Single Wishlist Delete.
    public function wishlistDelete($id){
        Wishlist::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Wishlist Delete Successfully',
            'alert-type' => 'success'
        );

        // Toastr Alert
        return back()->with($notification);
    }
}
