<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
    return view('frontend.index');
});

// Admin Dashboard
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[adminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[adminController::class,'adminDestroy'])->name('admin.logout');
    Route::get('/admin/profile',[adminController::class,'adminProfile'])->name('admin.adminprofile');
    Route::post('/admin/profile/store',[adminController::class,'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/password/change',[adminController::class,'adminPasswordChange'])->name('admin.admin_password_change');
    Route::post('/admin/password/update',[adminController::class,'adminPasswordUpdate'])->name('admin.admin_password_update');
});


Route::get('/admin/login',[adminController::class,'AdminLogin'])->name('admin.adminLogin');
Route::get('/vendor/login',[vendorController::class,'VendorLogin'])->name('vendor.login');
Route::get('/become/vendor',[vendorController::class,'BecomeVendor'])->name('become.vendor');
Route::post('/register/vendor',[vendorController::class,'RegisterVendor'])->name('register.vendor');

// Vendor Dashboard
Route::middleware(['auth','role:vendor'])->group(function(){
    Route::get('/vendor/dashboard',[vendorController::class,'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout',[vendorController::class,'vendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile',[vendorController::class,'vendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store',[vendorController::class,'vendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/password/change',[vendorController::class,'vendorPasswordChange'])->name('vendor.vendor_password_change');
    Route::post('/vendor/password/update',[vendorController::class,'vendorPasswordUpdate'])->name('vendor.vendor_password_update');
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

// Brand Portion
Route::middleware(['auth','role:admin'])->group(function(){
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
});

// Category Portion
Route::middleware(['auth','role:admin'])->group(function(){
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
});

// Subcategory Portion
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(SubcategoryController::class)->group(function(){
        Route::get('all/subcategory/','AllSubCategory')->name('all.subcategory');
        Route::get('/get/category/','addCategory');
        Route::post('/add_subcategory/','addSubCategory');
        Route::get('/show_subcategory/','showSubCategory');
        Route::post('/active_subcategory/{id}','ActiveSubCategory');
        Route::post('/inactive_subcategory/{id}','InactiveSubCategory');
        Route::get('/delete_subcategory/{id}','DeleteSubCategory');
    });
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(vendorController::class)->group(function(){
        Route::get('/active/vendor','ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor','InactiveVendor')->name('inactive.vendor');
        Route::get('/add_inactive/vendor/{id}','AddInactiveVendor')->name('add.inactive');
        Route::get('/add_active/vendor/{id}','AddActiveVendor')->name('add.active');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
