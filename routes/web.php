<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;


use App\Http\Controllers\Frontend\ProductDetails;
use App\Http\Controllers\Frontend\VendorDetailsController;
use App\Http\Controllers\Frontend\VendorListGridController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\User\WishlistController;
use App\Http\Controllers\Frontend\User\CompareProductController;
use App\Http\Middleware\RedirectIfAuthenticated;


Route::get('/',[ProductDetails::class,'index']);

// Admin Dashboard
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(adminController::class)->group(function(){
        Route::get('/admin/dashboard','adminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout','adminDestroy')->name('admin.logout');
        Route::get('/admin/profile','adminProfile')->name('admin.adminprofile');
        Route::post('/admin/profile/store','adminProfileStore')->name('admin.profile.store');
        Route::get('/admin/password/change','adminPasswordChange')->name('admin.admin_password_change');
        Route::post('/admin/password/update','adminPasswordUpdate')->name('admin.admin_password_update');
    });

    // Vendor Portion
    Route::controller(vendorController::class)->group(function(){
        Route::get('/active/vendor','ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor','InactiveVendor')->name('inactive.vendor');
        Route::get('/add_inactive/vendor/{id}','AddInactiveVendor')->name('add.inactive');
        Route::get('/add_active/vendor/{id}','AddActiveVendor')->name('add.active');
    });
    
    // Brand Portion
    Route::controller(BrandController::class)->group(function(){
        Route::get('all/brand/','AllBrand')->name('all.brand');

        // Add Brand Store
        Route::post('/add_brand_store','AddBrandStore')->name('brand.add.store');
        // Show Data
        Route::get('/show_brand','ShowBrand')->name('brand.show_brand');
        // Making Inactive
        Route::post('/active_brand/{id}','ActiveBrand')->name('brand.active_brand');
        // Making Active
        Route::post('/inactive_brand/{id}','InactiveBrand')->name('brand.inactive_brand');

        // Delete
        Route::get('/brand_delete/{id}','DestroyBrand')->name('brand.brand_delete');

        // edit part
        Route::get('/edit_brand/{id}','EditBrand');
        Route::post('/update_brand/{id}','UpdateBrand');
     });

     // Category Portion
     Route::controller(CategoryController::class)->group(function(){
        Route::get('all/category/','AllCategory')->name('all.category');
        // Route to add data
        Route::post('/add_category/','AddCategory');
        // Show Data
        Route::get('/show_category/','ShowCategory');
        // Category Inactive
        Route::post('/active_category/{id}','ActiveCategory');
        // Category Active
        Route::post('/inactive_category/{id}','InactiveCategory');
        // Category Delete
        Route::get('/delete_category/{id}','DeleteCategory');
        // Category Edit & Update
        Route::get('/edit_category/{id}','EditCategory');
        Route::post('/update_category/{id}','UpdateCategory');
    });

    // Subcategory Portion
    Route::controller(SubcategoryController::class)->group(function(){
        Route::get('all/subcategory/','AllSubCategory')->name('all.subcategory');
        Route::get('/get/category/','addCategory');
        Route::post('/add_subcategory/','addSubCategory');
        Route::get('/show_subcategory/','showSubCategory');
        Route::post('/active_subcategory/{id}','ActiveSubCategory');
        Route::post('/inactive_subcategory/{id}','InactiveSubCategory');
        Route::get('/delete_subcategory/{id}','DeleteSubCategory');
    });

    // Product CRUD PART
    Route::controller(ProductController::class)->group(function(){
        Route::get('all/product','AllProduct')->name('all_product');
        Route::get('/view/product/','ShowProduct');
        Route::get('add/product','AddProduct')->name('add_product');
        Route::get('/subcategory/values/{cat_id}','ShowSubCategory');
        Route::post('/store/products','StoreProduct')->name('store_products');
        Route::get('/delete/product/{id}','DeleteProduct');
        Route::get('/active/product/{id}','ActiveProduct');
        Route::get('/inactive/product/{id}','InactiveProduct');
    
        Route::get('/edit/product/{id}','EditProduct');
        Route::post('/update/products/{id}','UpdateProduct')->name('update_products');
    
        Route::post('/update/mainThumbnail/{id}','UpdateMainThumbnail')->name('update_mainThumbnail');
        Route::post('/update/multiImages/{id}','UpdateMultiImages')->name('update_multiImages');
        Route::get('/delete/multiImages/{id}','DeleteMultiImages')->name('delete_multi_images');
    });

    Route::controller(SliderController::class)->group(function(){
        Route::get('all/slider/','AllSlider')->name('all.slider');
        Route::post('/add_slider/','AddSlider');
        Route::get('/show_slider/','ShowSlider');
        Route::get('/delete_slider/{id}','DeleteSlider');
        Route::get('/edit_slider/{id}','EditSlider');
        Route::post('/update_slider/{id}','UpdateSlider');
        Route::get('/active_slider/{id}','ActiveSlider');
        Route::get('/inactive_slider/{id}','InactiveSlider');
    });

    Route::controller(BannerController::class)->group(function(){
        Route::get('all/banner/','AllBanner')->name('all.banner');
        Route::post('/add_banner/','AddBanner');
        Route::get('/show_banner/','ShowBanner');
        Route::get('/delete_banner/{id}','DeleteBanner');
        Route::get('/edit_banner/{id}','EditBanner');
        Route::post('/update_banner/{id}','UpdateBanner');
        Route::get('/active_banner/{id}','ActiveBanner');
        Route::get('/inactive_banner/{id}','InactiveBanner');
    });

    Route::controller(CouponController::class)->group(function(){
        Route::get('all/coupon/','AllCoupon')->name('all.coupon');
        Route::post('/add_coupon/','AddCoupon');
        Route::get('/show_coupon/','ShowCoupon');
        Route::post('/inactive_coupon/{id}','InactiveCoupon');
        Route::post('/active_coupon/{id}','ActiveCoupon');
        Route::get('/delete_coupon/{id}','DeleteCoupon');
        Route::get('/edit_coupon/{id}','EditCoupon');
        Route::post('/update_coupon/{id}','UpdateCoupon');
    });


});


Route::get('/admin/login',[adminController::class,'AdminLogin'])->name('admin.adminLogin')->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login',[vendorController::class,'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor',[vendorController::class,'BecomeVendor'])->name('become.vendor')->middleware(RedirectIfAuthenticated::class);
Route::post('/register/vendor',[vendorController::class,'RegisterVendor'])->name('register.vendor')->middleware(RedirectIfAuthenticated::class);

// Vendor Dashboard
Route::middleware(['auth','role:vendor'])->group(function(){
    Route::controller(vendorController::class)->group(function(){
        Route::get('/vendor/dashboard','vendorDashboard')->name('vendor.dashboard');
        Route::get('/vendor/logout','vendorDestroy')->name('vendor.logout');
        Route::get('/vendor/profile','vendorProfile')->name('vendor.profile');
        Route::post('/vendor/profile/store','vendorProfileStore')->name('vendor.profile.store');
        Route::get('/vendor/password/change','vendorPasswordChange')->name('vendor.vendor_password_change');
        Route::post('/vendor/password/update','vendorPasswordUpdate')->name('vendor.vendor_password_update');
    });

    // Vendor Product CRUD
    Route::controller(VendorProductController::class)->group(function(){
        Route::get('/all/product/vendor/','AllProductVendor')->name('all_product_vendor');
        Route::get('/view/product/vendor/','ShowProductVendor');

        Route::get('add/product/vendor/','AddProductVendor')->name('add_product_vendor');
        Route::get('/subcategory/values/vendor/{cat_id}','ShowSubCategoryVendor');
        Route::post('/store/products/vendor/','StoreProductVendor')->name('store_products_vendor');

        Route::get('/delete/product/vendor/{id}','DeleteProductVendor');
        Route::get('/active/product/vendor/{id}','ActiveProductVendor');
        Route::get('/inactive/product/vendor/{id}','InactiveProductVendor');

        Route::get('/edit/product/vendor/{id}','EditProductVendor');
        Route::post('/update/products/vendor/{id}','UpdateProductVendor')->name('update_products_vendor');

        Route::post('/update/mainThumbnail/vendor/{id}','UpdateMainThumbnailVendor')->name('update_mainThumbnail_vendor');
        Route::post('/update/multiImages/vendor/{id}','UpdateMultiImagesVendor')->name('update_multiImages_vendor');
        Route::get('/delete/multiImages/vendor/{id}','DeleteMultiImagesVendor')->name('delete_multi_images_vendor');

    });

});

// User Dashboard
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard',[UserController::class,'UserDashboard'])->name('user.dashboard');
    Route::get('/index/logout',[UserController::class,'UserDestroy'])->name('user.logout');
    Route::post('/dashboard',[UserController::class,'UserPasswordUpdate'])->name('user.user_password_update');
});
Route::get('/phpinfo', function() {
    phpinfo();
});

Route::middleware(['auth','role:user'])->group(function(){
    Route::controller(WishlistController::class)->group(function(){
        Route::post('/product/addToWishList/{product_id}','InsertWishList');
        Route::get('shop/wishlist/','viewWishList')->name('shop_wishlist');
        Route::get('/all/wishlist/','wishListAjax');
        Route::get('/wish/product/remove/{id}','wishProductRemove');
    });

    Route::controller(CompareProductController::class)->group(function(){
        Route::get('all/product/compare/','productComparePage')->name('product_compare');
        Route::post('/product/compare/{product_id}','InsertProductCompare');
        Route::get('/show/compare/product/','ShowCompareProduct');
        Route::get('/compare/product/remove/{id}','CompareProductRemove');
    });

    Route::controller(ProductDetails::class)->group(function(){
        Route::get('product/details/{id}/{slug}','ProductDetails');
        Route::get('category/product/{id}/{slug}','CategoryProduct');
        Route::get('subcategory/product/{id}/{slug}','SubCategoryProduct');
        Route::get('/product/modal/view/{id}','ProductModalView');
    });

    

    Route::controller(CartController::class)->group(function(){
        Route::post('/cart/data/store/{id}','AddToCart');
        Route::post('/cart/data/store/wish/{id}','AddToCartWish');
        Route::post('/cart/data/store/compare/{id}','AddToCartCompare');
    
        Route::get('/product/mini/cart/','AddToMiniCart');
        Route::get('/cart/product/remove/{id}','CartProductRemove');
    
        Route::post('/main/cart/store/{id}','AddToCartMainPage');
        Route::get('/main/cart/page/','IndexCartPage')->name('cart-page');
        Route::get('/all/cart/products/','AddToMiniCart');
        Route::get('/increment_quantity/{id}','QuantityIncrement');
        Route::get('/decrement_quantity/{id}','QuantityDecrement');
        Route::get('/main/cart/remove/{id}','CartProductRemove');
    });
});

Route::get('/vendor/details/{id}',[VendorDetailsController::class,'VendorDetails'])->name('vendorDetailsInfo');
Route::get('vendor/list/',[VendorListGridController::class,'VendorList'])->name('vendor_list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
