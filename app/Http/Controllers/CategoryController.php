<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function CategoryList()
    {
        return view('backend.category.category-list', [
            // lastest() dia Data gulo ke Decending kora hoy. Last input data fast show korbe.
            //simplepaginate() dia pagination design kora hoichy.
            'category' => Category::with('Product')->latest()->simplepaginate(5),
            // Total Category Item koyta achy seita dekhanor jonno count() function
            'category_count' => Category::count(),

        ]);
    }

    public function CategoryAdd()
    {
        return view('backend.category.category-add');
    }

    public function CategoryPost(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'min:5', 'max:30', 'unique:categories'],
            'slug' => ['unique:categories'],
        ]);
        // Eloquent ORM Method for Data insert and update
        $cat = new Category;
        $cat->category_name = $request->category_name;
        $cat->slug = Str::slug($request->category_name);
        $cat->save();

        return back()->with('success', 'Category Add Successfully.');
    }

    public function CategoryEdit($id)
    {
        return view('backend.category.category-edit', [

            'category' => Category::findOrFail($id)
        ]);
    }

    public function CategoryUpdate(Request $request)
    {
        // Eloquent ORM Method for Data insert and update
        $category = Category::findOrFail($request->cat_id);
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->save();

        $notification = array(
            'message' => 'Category Update Successfully.',
            'alert-type' => 'success'
        );

        // Toastr Alert
        return back()->with($notification);

        //  SweetAlert2
        // return back()->with('success', 'Created successfully!');
        // return redirect('admin/category-list')->with('success', 'Category Update Successfully.');

        // Query Builder Method for Data insert and update:

    }

    // Category Soft Delete.
    public function CategoryDelete($id)
    {
        $check = Product::where('category_id', $id)->count();
        if($check > 0){
            Product::where('category_id', $id)->update([
                'category_id' => 1,
            ]);
        }
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category Delete Successfully.');
    }

    // Category Muilti Delete.
    public function CategorySelectedDelete(Request $request)
    {
        if($request->cat_id){
            foreach ($request->cat_id as $categoryid){
                Category::findOrFail($categoryid)->delete();
            }
            return back()->with('success', 'Category move to trashed successflly');
        }else{
            return back()->with('error', 'Selete Your Data.');
        }
    }

    // Category Trash List
    public function CategoryTrashList()
    {
        return view('backend.category.category-trashlist',[
            'CategoryTrashlist' => Category::onlyTrashed()->simplePaginate(5),
            'Category_count' => Category::onlyTrashed()->count(),
        ]);
    }

    // Category Restore From Trash list.
    public function CategoryRestore($id)
    {
        Category::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Category Restore Successfully.');
    }

    // Category Permanent Delete Form Trash List.
    public function CategoryPermanentDelete($id)
    {
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Category Delete Permanetly.');
    }

    // Category Selected Delete and Resote.
    public function CatSelectDeleteRestore(Request $request)
    {
        if($request->trash_cat_id){
            // Category Selected Delete From Trashed.
            if($request->delete){
                foreach($request->trash_cat_id as $cat_id){
                    Category::onlyTrashed()->findOrFail($cat_id)->forceDelete();
                }
                return back()->with('success', 'Category Delete Permanently.');
            }else{
                 // Category Selected Restore From Trashed.
                if($request->restore){
                    foreach($request->trash_cat_id as $cat_id){
                        Category::onlyTrashed()->findOrFail($cat_id)->restore();
                    }
                    return back()->with('success', 'Category Restore Successfully.');
                }
            }
        }else{
            return back()->with('error', 'Selete Your Data.');
        }
    }


}
