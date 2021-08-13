<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ProductAttribute;
use App\Models\Size;
use App\Models\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{

    function GetSubcate($cat_id){
        $subcat = SubCategory::where('category_id', $cat_id )->get();
        return response()->json($subcat);
    }

    function GetBrand($cate_id){
        $brand = Brand::where('category_id', $cate_id)->get();
        return response()->json($brand);
    }

    function ProductAdd(){
        return view('backend.product.product_form', [
            'ProductCategory' => Category::orderBy('category_name', 'asc')->get(),
            'brands' => Brand::orderBy('brand_name', 'asc')->get(),
            'color' => Color::orderBy('color_name', 'asc')->get(),
            'size' => Size::orderBy('size', 'asc')->get(),
        ]);
    }

    function ProductView(){
        return view('backend.product.product_list', [
            'prouctCount' => Product::count(),
            'productList' => Product::with(['Category', 'SubCategory','ProductGallery', 'Brand', 'ProductAttribute.color'])->latest()->simplePaginate(),
        ]);
    }

    function ProductPost (Request $request){
        $request->validate([
            'title' => ['required', 'unique:products'],
            'slug' => ['required', 'unique:products'],
            'cateogryName' => ['required'],
            'subcategory' => ['required'],
            'productPrice' => ['required'],
            'defaultPrice' => ['required'],
            'thumbnail' => ['required'],
            'productSummary' => ['required'],
            'productDesc' => ['required'],
            'color' => ['required']
        ],[
          'cateogryName.required' => 'Please Seletec One',
          'thumbnail.required' => 'Upload Product Thumbnail.',
        ]);
        $product = new Product;
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->subcategory_id = $request->subcategory;
        $product->category_id = $request->cateogryName;
        $product->brand_id = $request->BrandName;
        $product->brand_id = $request->BrandName;
        $product->product_price = $request->defaultPrice;
        $product->summary = $request->productSummary;
        $product->description = $request->productDesc;
        $product->save();

        // Product Attributes Data Insert
        $productPrices = $request->productPrice;
        foreach( $productPrices as $key => $productPrice){
            $productAtt = new ProductAttribute;
            $productAtt->product_id = $product->id;
            $productAtt->price = $productPrice;
            $productAtt->quantity =  $request->quantity[$key];
            $productAtt->color_id =  $request->color[$key];
            $productAtt->size_id =  $request->size[$key];
            $productAtt->save();
        }
        // Single Product Upload Code
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $extn = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $new = Product::findOrfail($product->id);
            $path = public_path('images/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->save($path . $extn);
            $new->product_thumbnail = $extn;
            $new->save();
        }
        // Multiple Product Upload Code
        if($request->hasFile('productImage')){
            $productGalleryImg = $request->file('productImage');
            foreach( $productGalleryImg as $productGallImg ){
                $extention = Str::slug($request->title).'-'.Str::random(3).'.'.$productGallImg->getClientOriginalExtension();
                $path = public_path('images/product-gallery/'.$product->created_at->format('Y/m/').$product->id.'/');
                File::makeDirectory($path, $mode= 0777, true, true );
                Image::make($productGallImg)->save($path . $extention);
                $productImg = new ProductGallery;
                $productImg->product_id = $product->id;
                $productImg->image_name = $extention;
                $productImg->save();
            }
        }
        return back()->with('success', 'Product Add Successfully.');
    }

    function ProductDelete($id){
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product move to trashed successfully.');
    }

    function ProductTrashlist(){
        return view('backend.product.product_trashlist', [
            'product_trashlist' => Product::onlyTrashed()->simplePaginate(5),
            'prouctCount' => Product::onlyTrashed()->count(),
        ]);
    }

    function ProductRestore($id)
    {
        Product::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Product Restore Successfully.');
    }

    function ProductPerDelete($id)
    {
        Product::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Product permanently deleted.');
    }

    function ProductEdit($id){
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', [
           'product' => $product,
           'ProductCategory' => Category::orderBy('category_name', 'asc')->get(),
           'brands' => Brand::orderBy('brand_name', 'asc')->get(),
           'ProductSubCategory' => SubCategory::where('category_id', $product->category_id)->orderBy('subcategory_name', 'asc')->get(),
           'color' => Color::orderBy('color_name', 'asc')->get(),
           'size' => Size::orderBy('size', 'asc')->get(),
           'totalAtribute' => ProductAttribute::where('product_id', $id)->get(),
        ]);
    }

    function ProductUpdate(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        $product->title = $request->productName;

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $extn = Str::slug($request->productName).'.'.$image->getClientOriginalExtension();
            $oldPath = public_path('images/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->product_thumbnail);
            if(file_exists($oldPath)){
                unlink($oldPath);
            };
            $path = public_path('images/'.$product->created_at->format('Y/m/').$product->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->resize(284, 294)->save($path . $extn, 70);
            $product->product_thumbnail = $extn;
        }

        $product->subcategory_id = $request->subcategory;
        $product->category_id = $request->cateogryName;
        $product->brand_id = $request->BrandName;
        $product->product_price = $request->productPrice;
        $product->summary = $request->productSummary;
        $product->description = $request->productDesc;
        $product->save();

         // Product Attributes Data Update
        $productSize = $request->size;
        foreach( $productSize as $key => $size){
            $ProductAttribute = ProductAttribute::findOrFail($request->productAttributeId[$key]);
            $ProductAttribute->product_id = $product->id;
            $ProductAttribute->size_id = $size;
            $ProductAttribute->quantity =  $request->quantity[$key];
            $ProductAttribute->color_id =  $request->color[$key];
            $ProductAttribute->price =  $request->attributePrice[$key];
            $ProductAttribute->save();
        }


        if($request->hasFile('image_name')){
            $images = $request->file('image_name');
            foreach($images as $key => $image1){
                $productGallery = ProductGallery::findOrFail($request->gallery_id[$key]);
                $img_exten = Str::slug($request->productName).'-'.Str::random(3).'.'.$image1->getClientOriginalExtension();
                $oldPath = public_path('images/product-gallery/'.$product->created_at->format('Y/m/').$productGallery->product_id.'/');
                if(file_exists($oldPath. $productGallery->image_name)){
                    unlink($oldPath.$productGallery->image_name );
                }
                File::makeDirectory($oldPath, $mode= 0777, true, true );
                Image::make($image1)->save($oldPath . $img_exten);
                $productGallery->product_id = $product->id;
                $productGallery->image_name = $img_exten;
                $productGallery->save();
            }
        }
        return back()->with('success', 'Product Update Successfully.');
    }


}
