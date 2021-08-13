<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    // Sub Category From
    public function SubCategoryAdd()
    {
        return view('backend.sub_category.subcategory-add', [
            'categoryName' => Category::get(),
        ]);
    }
    //Sub Category Insert
    public function SubCategoryPost(Request $request)
    {
        $request->validate([
            'subcategory_name' => ['required', 'unique:sub_categories'],
            'cateogryName' => ['required'],
        ], [
            'cateogryName.required' => 'Select Your Category',
        ]);
        $subcat = new SubCategory;
        $subcat->subcategory_name = $request->subcategory_name;
        $subcat->slug = Str::slug($request->subcategory_name);
        $subcat->category_id = $request->cateogryName;
        $subcat->save();
        return back()->with('success', 'Subcateogry Add Successfully.');
    }

    // Sub Category List view
    public function SubCategoryView()
    {
        return view('backend.sub_category.subcategory-list', [
            'subcategory_count' => SubCategory::count(),
            'subcategory' => SubCategory::with('Category')->orderBy('subcategory_name', 'asc')->simplePaginate(),
        ]);
    }

    // Sub Category Edit
    public function SubCategoryEdit($id){
        return view('backend.sub_category.subcategory_editform',[
            'subcategory' => SubCategory::findOrFail($id),
            'categoryName' => Category::orderBy('category_name', 'asc')->get(),
        ]);
    }

    // Sub Category Update
    public function SubcategoyUpdate(Request $request){
        $request->validate([
            'subcategory_name' => ['required'],
            'cateogryName' => ['required'],
        ],[
            'cateogryName.required' => 'Please Select Category',
        ]);
        $subcategory = SubCategory::findOrFail($request->subcat_id);
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->cateogryName;
        $subcategory->slug = Str::slug($request->subcategory_name);
        $subcategory->save();
        return back()->with('message', 'Sub-Category Update Successfully');
    }

    // Sub Category Delete
    public function SubcategoyDelete($id){
        SubCategory::findOrFail($id)->delete();
        return back()->with('success', 'Subcategory Delete Successfully.');
    }

    // Sub-Category Muilti Delete.
    public function SubCategorySelectedDelete(Request $request)
    {
        if($request->subcat_id){
            foreach ($request->subcat_id as $subcategoryid){
                SubCategory::findOrFail($subcategoryid)->delete();
            }
            return back()->with('success', 'Category move to trashed successflly');
        }else{
            return back()->with('error', 'Selete Your Data.');
        }
    }

    //Sub Cateogry Trash List.
    public function SubcategoryTrashlist(){
        return view('backend.sub_category.subcategory_trashlist', [
            'subcategoryTrashlist' => SubCategory::onlyTrashed()->simplePaginate(5),
        ]);
    }

    // Sub Category Restore from trashed list.
    public function SubcategoryRestore($id){
        SubCategory::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Subcategory Restore Successfully.');
    }

    public function SubcategoryPerDelete($id){
        Subcategory::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Subcategory Delete Successfully.');
    }
}
