<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistControler;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';
Route::get('/order-invoice', function () {
    return view('frontend.invoice.order-invoice');
});

// Frontend Pages Route.
Route::get('about', function(){
    return view('Frontend.pages.about');
})->name('about');

Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact-store', [ContactController::class, 'contactStore'])->name('contactStore');


Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');
Route::get('add-product-wishlist/{productId}', [WishlistControler::class, 'addToWishlist'])->name('addToWishlist');
Route::get('wishlist', [WishlistControler::class, 'wishlist'])->name('wishlist');
Route::get('wishlist/{id}', [WishlistControler::class, 'wishlistDelete'])->name('wishlistDelete');
Route::get('blogs', [BlogController::class, 'blogsPage'])->name('blogs');
Route::get('blogs/{slug}', [BlogController::class, 'blogDetails'])->name('blogDetails');
Route::get('category/blogs/{id}', [BlogController::class, 'categoryBlogs'])->name('categoryBlogs');
Route::get('blog-status/{id}/{status}', [BlogController::class, 'blogStatus'])->name('blogStatus');
Route::get('blog-feature/{id}/{postid}', [BlogController::class, 'blogFeaturePost'])->name('blogFeaturePost');
Route::get('blog-trash', [BlogController::class, 'trash_lish'])->name('blog.trash');
Route::get('blog-restore/{id}', [BlogController::class, 'blog_restore'])->name('blog.restore');





// add cart product from wishlist using Ajax.
// Route::post('wishlist-add-to-cart', [CartController::class, 'wishlistToCart'])->name('wishlistToCart');
Route::post('wishlist-add-to-cart', [WishlistControler::class, 'wishlistToCart'])->name('wishlistToCart');


Route::group(['prefix' => 'user'], function(){
    Route::get('login', [UserController::class, 'userLogin'])->name('userLogin');
    Route::get('register', [UserController::class, 'userRegister'])->name('userRegister');
    Route::post('/create', [UserController::class, 'create'])->name('createUser');
    Route::post('/check', [UserController::class, 'check'])->name('loginCheck');
    Route::get('/dashboard', [UserController::class, 'myAccount'])->name('myAccount')->middleware('verified');
    Route::get('/orders/{id}', [UserController::class, 'userOrder'])->name('userOrder');
});

Route::get('product/{slug}', [FrontendController::class, 'singleProduct'])->name('singleProduct');

Route::get('shop', [FrontendController::class, 'shop'])->name('shop');

Route::get('/get-product-size/{color_id}/{product_id}', [FrontendController::class, 'getProductSize'])->name('getProductSize');

Route::get('/get-product-size-2/{colorId}/{productId}', [FrontendController::class, 'getProductSizeForWishlist'])->name('getProductSizeForWishlist');


Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('cart/{slug}', [CartController::class, 'cart'])->name('couponCart');
// Route::get('single-cart/{slug}', [CartController::class, 'singleCart'])->name('singleCart');
Route::get('single-cart/delete/{id}', [CartController::class, 'cartDelet'])->name('cartDelet');
Route::post('/add-to-product-cart', [CartController::class, 'productCart'])->name('productCart');
// Route::post('/add-to-product-cart-from-model', [CartController::class, 'productCartFromModel'])->name('productCartFromModel');

// Product Review
Route::post('/product-review', [ProductReviewController::class, 'productReview'])->name('productReview')->middleware('auth');


Route::post('cart/update', [CartController::class, 'cartUpdate'])->name('cartUpdate');
Route::post('cart/update/ajax', [CartController::class, 'cartUpdateAjax'])->name('cartUpdateAjax');

// Checkout Page
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkout-post', [CheckoutController::class, 'checkPost'])->name('checkPost');

Route::get('paypal-status', [CheckoutController::class, 'PayPalStatus'])->name('PayPalStatus');

Route::get('api/get-state-list/{sateId}', [CheckoutController::class, 'getState'])->name('getState');
Route::get('api/get-city-list/{cityId}', [CheckoutController::class, 'getCity'])->name('getCity');
Route::get('api/get-upzilas-list/{upazilasId}', [CheckoutController::class, 'getUpazilas'])->name('getUpazilas');



// Backend Controller

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function(){
    Route::get('roles', [RoleController::class, 'roles'])->name('roles');
    Route::post('roles-store', [RoleController::class, 'rolesStore'])->name('rolesStore');
    Route::get('roles-and-permit', [RoleController::class, 'rolesAndPermit'])->name('rolesAndPermit');
    Route::get('roles-and-permit-eidt/{id}', [RoleController::class, 'rolesAndPermitEdit'])->name('rolesAndPermitEdit');
    Route::post('roles-as-permission', [RoleController::class, 'rollAsPermission'])->name('rollAsPermission');
    Route::get('permission', [RoleController::class, 'permission'])->name('permission');
    Route::post('permission-add', [RoleController::class, 'permissionStore'])->name('permissionStore');
    Route::get('user-roles', [RoleController::class, 'userRoles'])->name('userRoles');
    Route::post('user-assign-roll', [RoleController::class, 'userAssignRoles'])->name('userAssignRoles');
} );

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'role:admin|editor|writer']], function(){
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('category-list', [CategoryController::class, 'CategoryList'])->name('CategoryList');
    Route::get('category-add', [CategoryController::class, 'CategoryAdd'])->name('CategoryAdd');
    Route::post('category-post', [CategoryController::class, 'CategoryPost'])->name('CategoryPost');
    Route::get('category-edit/{cat_id}', [CategoryController::class, 'CategoryEdit'])->name('CategoryEdit');

    // {{-- Akhane cat_id akta argument jekhane id pass kora hobe edit and delete korar jonno --}}
    Route::post('category-update', [CategoryController::class, 'CategoryUpdate'])->name('CategoryUpdate');
    Route::get('category-delete/{cat_id}', [CategoryController::class, 'CategoryDelete'])->name('CategoryDelete');
    Route::get('category-trashlist', [CategoryController::class, 'CategoryTrashList'])->name('CategoryTrashList');
    Route::post('category-selecteddelete', [CategoryController::class, 'CategorySelectedDelete'])->name('CategorySelectedDelete');
    Route::get('category-restore/{cat_id}', [CategoryController::class, 'CategoryRestore'])->name('CategoryRestore');
    Route::get('category-permanent-delete/{cat_id}', [CategoryController::class, 'CategoryPermanentDelete'])->name('CategoryPermanentDelete');
    Route::post('category-selected-DeleteRestore',[CategoryController::class, 'CatSelectDeleteRestore'])->name('CatSelectDeleteRestore');

    //Sub-Category Start.
    Route::get('subcategory-add', [SubCategoryController::class, 'SubCategoryAdd'])->name('SubCategoryAdd');
    Route::post('subcategory-post', [SubCategoryController::class, 'SubCategoryPost'])->name('SubCategoryPost');
    Route::get('subcategory-view', [SubCategoryController::class, 'SubCategoryView'])->name('SubCategoryView');
    Route::get('subcategory-edit/{subcat_id}',[SubCategoryController::class, 'SubCategoryEdit'])->name('SubCategoryEdit');
    Route::post('subcategor-update', [SubCategoryController::class, 'SubcategoyUpdate'])->name('SubcategoyUpdate');
    Route::get('subcategory-delete/{subcat_id}', [SubCategoryController::class, 'SubcategoyDelete'])->name('SubcategoyDelete');
    Route::post('subcategory-multi-delete', [SubCategoryController::class, 'SubCategorySelectedDelete'])->name('SubCategorySelectedDelete');
    Route::get('subcategory-trashlist', [SubCategoryController::class, 'SubcategoryTrashlist'])->name('SubcategoryTrashlist');
    Route::get('subcategory-restore/{subcat_id}', [SubCategoryController::class, 'SubcategoryRestore'])->name('SubcategoryRestore');
    Route::get('subcategory-per-delete/{subcat_id}', [SubCategoryController::class, 'SubcategoryPerDelete'])->name('SubcategoryPerDelete');

    // Brand Route and Url
    Route::get('brand-add', [BrandController::class, 'brandAdd'])->name('brandAdd');
    Route::post('brand-post', [BrandController::class, 'brandPost'])->name('brandPost');
    Route::get('brand-list', [BrandController::class, 'brandView'])->name('brandView');
    Route::get('brand-edit', [BrandController::class, 'brandEdit'])->name('brandEdit');
    Route::get('brand-trash', [BrandController::class, 'brandTrash'])->name('brandTrash');

    // Product
    // ajax dia data request kore subcategory name show korano..
    Route::get('get-subcate/{cat_id}', [ProductController::class, 'GetSubcate'])->name('GetSubcate');
    Route::get('get-brand/{cat_id}', [ProductController::class, 'GetBrand'])->name('GetBrand');
    Route::get('product-add', [ProductController::class, 'ProductAdd'])->name('ProductAdd');
    Route::post('product-post', [ProductController::class, 'ProductPost'])->name('ProductPost');
    Route::get('product-list', [ProductController::class, 'ProductView'])->name('ProductView');
    Route::get('product-edit/{product_id}', [ProductController::class, 'ProductEdit'])->name('ProductEdit');
    Route::post('product-update', [ProductController::class, 'ProductUpdate'])->name('ProductUpdate');
    Route::get('product-delete/{product_id}', [ProductController::class, 'ProductDelete'])->name('ProductDelete');
    Route::get('product-restore/{product_id}', [ProductController::class, 'ProductRestore'])->name('ProductRestore');
    Route::get('product-permanent-delete/{product_id}', [ProductController::class, 'ProductPerDelete'])->name('ProductPerDelete');
    Route::get('product-trashlist', [ProductController::class, 'ProductTrashlist'])->name('ProductTrashlist');
    // Route::post('product-review', [ProductController::class, 'productReview'])->name('productReview');

    // Orders
    Route::get('orders', [DashboardController::class, 'orders'])->name('orders');
    Route::get('orders-view/{id}', [DashboardController::class, 'ordersView'])->name('ordersView');
    Route::get('orders-search', [DashboardController::class, 'orderSearch'])->name('orderSearch');
    Route::get('orders-downlod-report', [DashboardController::class, 'downloadFile'])->name('downloadFile');

    // Coupon Code
    Route::get('coupon', [CouponController::class, 'coupon'])->name('coupon');
    Route::post('coupon-post', [CouponController::class, 'couponPost'])->name('couponPost');
    Route::get('coupon-edit/{couponId}', [CouponController::class, 'couponEdit'])->name('couponEdit');
    Route::post('coupon-updated', [CouponController::class, 'couponUpdated'])->name('couponUpdated');
    Route::get('coupon-deleted/{id}', [CouponController::class, 'couponDelete'])->name('couponDelete');

    // Contact Message Backend Route:
    Route::get('/message', [ContactController::class, 'message'])->name('message');
    Route::get('/message-trash', [ContactController::class, 'messageTrash'])->name('messageTrash');
    Route::get('get-readStatus/{msgid}', [ContactController::class, 'ajaxReadStatus'])->name('ajaxReadStatus');
    Route::get('/message-view/{id}', [ContactController::class, 'messageview'])->name('messageview');
    Route::get('/message-softdelte/{id}', [ContactController::class, 'messageSoftDelete'])->name('messageSoftDelete');
    Route::get('/message-restore/{id}', [ContactController::class, 'messageRestore'])->name('messageRestore');
    Route::get('/message-destroy/{id}', [ContactController::class, 'messageDestroy'])->name('messageDestroy');


    Route::resource('blog', BlogController::class);
});




// Jei Page Theke Logout kora hobe sei page a login korle redirect kore oi page a nia jabe.
Route::get('/redirects', function(){
    return redirect(Redirect::intended()->getTargetUrl());
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/cache-clear', function(){
    Artisan::call('cache:clear');
    return back();
});
