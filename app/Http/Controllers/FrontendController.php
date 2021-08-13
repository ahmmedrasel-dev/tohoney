<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductAttribute;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use DB;
use Auth;

class FrontendController extends Controller
{

    function frontend(){
        $latestProduct = Product::with(['Category', 'SubCategory', 'ProductAttribute'])->latest()->get();
        $oldCookie_id = cookie('cookie_id');

        $carts = Cart::with(['Product','Color', 'Size'])->where('cookie_id', $oldCookie_id )->get();
        $bestSelling = Order::select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'DESC')->limit(8)->get();

        return view('Frontend.main', [
            'latest_products' => $latestProduct,
            'carts' => $carts,
            'bestSellings' => $bestSelling,
        ]);
    }

    function singleProduct($slug){
        $product = Product::where('slug', $slug)->first();
        $relatedProduct = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
        $ratting = ProductReview::where('product_id', $product->id)->where('user_id', Auth::id())->count();
        $reviews = ProductReview::where('product_id', $product->id)->get();
        $productAttri = ProductAttribute::where('product_id', $product->id )->get();
        $collect = collect($productAttri);
        $groupby = $collect->groupBy('color_id');
        return view('Frontend.pages.single-products', [
           'singleProducts' => $product,
           'groupByColor' => $groupby,
           'rattings' => $ratting,
           'reviews' => $reviews,
           'relatedProduct' => $relatedProduct,
        ]);
    }



    function getProductSize($colorId, $productId){
        $output = '';
        $productAttribute = ProductAttribute::where('color_id', $colorId )->where('product_id', $productId)->get();
        foreach ($productAttribute as $value) {
           $output = $output.'<option name="size_id" class="sizecheck" id="size" data-quantity="'.$value->quantity.'" data-price="'.$value->price.'" value="'.$value->size_id.'">'.$value->Size->size.'</option>';
        }

        echo $output;
    }


    function getProductSizeForWishlist($colorId, $productId){

        $output = '';
        $productAttribute = ProductAttribute::where('color_id', $colorId )->where('product_id', $productId)->get();
        foreach ($productAttribute as $value) {
           $output = $output.'<option name="size_id" data-quantity="'.$value->quantity.'" data-price="'.$value->price.'" value="'.$value->size_id.'">'.$value->Size->size.'</option>';
        }

        echo $output;
    }


    function shop(){
        return view('frontend.pages.shop', [
            'categories' => Category::with('Product')->orderBy('category_name', 'asc')->get(),
            'products' => Product::with(['Category', 'ProductAttribute', 'SubCategory'])->latest()->get(),
        ]);
    }
}
