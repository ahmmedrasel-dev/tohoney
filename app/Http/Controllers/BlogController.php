<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class BlogController extends Controller
{

    // Display Blog Post Frondend Design
    public function blogsPage()
    {
        return view('Frontend.pages.blogs', [
            'blogs' => Blog::with(['user', 'category'])->where('status', 1)->latest()->get(),
        ]);
    }

    // Display Single Blog in Details Page.
    public function blogDetails($slug)
    {
        return view('Frontend.pages.blog-details', [
            'blogItem' => Blog::where('slug', $slug)->first(),
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'recent_blog' => Blog::latest()->limit(5)->get(),
        ]);
    }

    public function categoryBlogs($catId)
    {
        return view('Frontend.pages.blog-category', [
            'categoryBlogs' => Blog::where('category_id', $catId )->get(),
        ]);
    }

    // Blog Active and Deactive Code.
    public function blogStatus($id, $status)
    {
        if($status == 1){
            Blog::where('id', $id)->update(['status' => 2]);
        }elseif($status == 2 ){
            Blog::where('id', $id)->update(['status' => 1]);
        }
    }

    // Blog Feature and General Post.
    public function blogFeaturePost($id, $postid)
    {
        if($postid == 1){
            Blog::where('id', $id)->update(['feature_post' => 2]);
        }elseif($postid == 2 ){
            Blog::where('id', $id)->update(['feature_post' => 1]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.blog.blog-index', [
            'blogs' => Blog::orderBy('id', 'desc')->simplepaginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.blog.blog-create', [
            'categories' => Category::orderBy('category_name', 'asc')->get(),
        ]);
    }

    // Display Subcetegory When Change Category.
    function GetSubcate($cat_id){
        $subcat = SubCategory::where('category_id', $cat_id )->get();
        return response()->json($subcat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $blogs = new Blog;
        $blogs->user_id = Auth::id();
        $blogs->category_id = $request->category_id;
        $blogs->subcat_id = $request->subcat_id;
        $blogs->title = $request->title;
        $blogs->slug = $request->slug;
        $blogs->short_description = $request->short_description;
        $blogs->save();

        // Upload Blogs Thumbnail Code
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $extn = Str::slug($request->title).'.'.Str::random(3).'.'.$image->getClientOriginalExtension();
            $new = Blog::findOrfail($blogs->id);
            $path = public_path('blog_images/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->save($path . $extn);
            $new->thumbnail = $extn;
            $new->save();
        }

        // Upload Blogs Thumbnail Code
        if($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $extn = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $new = Blog::findOrfail($blogs->id);
            $path = public_path('blog_images/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->save($path . $extn);
            $new->feature_image = $extn;
            $new->save();
        }

        $blogsTag = $request->tags;
        foreach ( $blogsTag as $value) {
            $keyword = new Keyword;
            $keyword->blog_id = $blogs->id;
            $keyword->keyword = $value;
            $keyword->save();
        }



        $notification = array(
            'message' => 'Blog post created successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('backend.blog.blog-edit', [
            'blogs' => $blog,
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'subcategories' => SubCategory::where('category_id', $blog->category_id)->orderBy('subcategory_name', 'asc')->get(),
            // 'keywords' => Keyword::where('blog_id', $blog->id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->user_id = Auth::id();
        $blog->category_id = $request->category_id;
        $blog->subcat_id = $request->subcat_id;
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->short_description = $request->short_description;
        $blog->save();

        // Upload Blogs Thumbnail Code
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $extn = Str::slug($request->title).'.'.Str::random(3).'.'.$image->getClientOriginalExtension();
            $new = Blog::findOrfail($blog->id);
            $path = public_path('blog_images/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->save($path . $extn);
            $new->thumbnail = $extn;
            $new->save();
        }

        // Upload Blogs Thumbnail Code
        if($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $extn = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $new = Blog::findOrfail($blog->id);
            $path = public_path('blog_images/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->save($path . $extn);
            $new->feature_image = $extn;
            $new->save();
        }

        $blogsTag = $request->tags;
        // $keyword = Keyword::findOr
        foreach ( $blogsTag as $key => $value) {
            $keyword = Keyword::findOrFail($request->keyword_id[$key]);
            $keyword->blog_id = $blog->id;
            $keyword->keyword = $value;
            $keyword->save();
        }



        $notification = array(
            'message' => 'Blog post updated successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        $notification = array(
            'message' => 'Blog move to trashed successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }

    public function trash_lish()
    {
        return view('backend.blog.blog-trash', [
            'blogsTrash' => Blog::onlyTrashed()->simplepaginate(),
        ]);
    }

    public function blog_restore($id)
    {
        Blog::onlyTrashed()->findOrFail($id)->restore();
        $notification = array(
            'message' => 'Blog restore successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }
}
