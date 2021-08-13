<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    //Brand Add Form
    function brandAdd(){
        return view('backend.Brand.brand-add', [
            'categoryName' => Category::get(),
        ]);
    }

    //Brand Instert Into Database.
    function brandPost(Request $request){
        // Brand Validation.
        // $request->validate([
        //     'brand_name' => ['required', 'unique:brands'],
        //     'slug' => ['required', 'unique:brands'],
        //     'category_id' => ['required', 'unique:brands'],
        // ],[
        //     'category_id.required' => 'Please Select Brand Category',
        // ]);

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;

        $brand->slug = Str::slug($request->brand_name);
        $brand->category_id	 = $request->category_id;
        $brand->save();

        if($request->hasFile('brand_logo')){
            $brand_logo = $request->file('brand_logo');
            $extention = Str::slug($request->brand_name).'.'.$brand_logo->getClientOriginalExtension();
            // $newBrand = Brand::findOrFail($brand->id);
            $path = public_path('images/brand-logo/'.$brand->created_at->format('Y/m/').$brand->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($brand_logo)->save($path . $extention);
            $brand->brand_logo = $extention;
            $brand->save();
        }

        return back()->with('success', 'Brand Add Successfully.');
    }


    function brandView(){
        return view('backend.Brand.brand-list',[
            'brand' => Brand::with(['Category', 'Product'])->orderBy('brand_name', 'asc')->simplePaginate(),
            'totalBrand' => Brand::count()
        ]);
    }

    function brandTrash(){

    }
}
