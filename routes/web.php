<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialLoginAPIController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\shippingController;
use App\Http\Controllers\Backend\ProductOrderManagement;
use App\Http\Controllers\Backend\CancelReturnProductController;
use App\Http\Controllers\Backend\OrderReporsManageController;
use App\Http\Controllers\Backend\UserStatusController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SiteSettingsController;
use App\Http\Controllers\Backend\RoleController;


use App\Http\Controllers\Frontend\ProductDetails;
use App\Http\Controllers\Frontend\VendorDetailsController;
use App\Http\Controllers\Frontend\VendorListGridController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\BlogDetailsListController;
use App\Http\Controllers\Frontend\Shipping\ShippingProductController;
use App\Http\Controllers\Frontend\User\WishlistController;
use App\Http\Controllers\Frontend\User\CompareProductController;
use App\Http\Controllers\Frontend\User\StripeController;
use App\Http\Controllers\Frontend\User\AllUserController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ShopFilterController;
use App\Http\Middleware\RedirectIfAuthenticated;


Route::get('/', [ProductDetails::class, 'index']);

// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(adminController::class)->group(function () {
        Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'adminDestroy')->name('admin.logout');
        Route::get('/admin/profile', 'adminProfile')->name('admin.adminprofile');
        Route::post('/admin/profile/store', 'adminProfileStore')->name('admin.profile.store');
        Route::get('/admin/password/change', 'adminPasswordChange')->name('admin.admin_password_change');
        Route::post('/admin/password/update', 'adminPasswordUpdate')->name('admin.admin_password_update');

        // ############# MULTIPLE ADMIN HANDLE ################ //
        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/admin/user/store', 'AdminUserStore')->name('admin.user.store');
        Route::get('/edit/admin/role/{id}', 'EditAdminRole')->name('edit.admin.role');
        Route::post('/admin/user/update/{id}', 'AdminUserUpdate')->name('admin.user.update');
        Route::get('/delete/admin/role/{id}', 'DeleteAdminRole')->name('delete.admin.role');
    });

    // Vendor Portion
    Route::controller(vendorController::class)->group(function () {
        Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
        Route::get('/add_inactive/vendor/{id}', 'AddInactiveVendor')->name('add.inactive');
        Route::get('/add_active/vendor/{id}', 'AddActiveVendor')->name('add.active');
    });

    // Brand Portion
    Route::controller(BrandController::class)->group(function () {
        Route::get('all/brand/', 'AllBrand')->name('all.brand');

        // Add Brand Store
        Route::post('/add_brand_store', 'AddBrandStore')->name('brand.add.store');
        // Show Data
        Route::get('/show_brand', 'ShowBrand')->name('brand.show_brand');
        // Making Inactive
        Route::post('/active_brand/{id}', 'ActiveBrand')->name('brand.active_brand');
        // Making Active
        Route::post('/inactive_brand/{id}', 'InactiveBrand')->name('brand.inactive_brand');

        // Delete
        Route::get('/brand_delete/{id}', 'DestroyBrand')->name('brand.brand_delete');

        // edit part
        Route::get('/edit_brand/{id}', 'EditBrand');
        Route::post('/update_brand/{id}', 'UpdateBrand');
    });

    // Category Portion
    Route::controller(CategoryController::class)->group(function () {
        Route::get('all/category/', 'AllCategory')->name('all.category');
        // Route to add data
        Route::post('/add_category/', 'AddCategory');
        // Show Data
        Route::get('/show_category/', 'ShowCategory');
        // Category Inactive
        Route::post('/active_category/{id}', 'ActiveCategory');
        // Category Active
        Route::post('/inactive_category/{id}', 'InactiveCategory');
        // Category Delete
        Route::get('/delete_category/{id}', 'DeleteCategory')->name('delete.category');
        // Category Edit & Update
        Route::get('/edit_category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update_category/{id}', 'UpdateCategory');
    });

    // Subcategory Portion
    Route::controller(SubcategoryController::class)->group(function () {
        Route::get('all/subcategory/', 'AllSubCategory')->name('all.subcategory');
        Route::get('/get/category/', 'addCategory');
        Route::post('/add_subcategory/', 'addSubCategory');
        Route::get('/show_subcategory/', 'showSubCategory');
        Route::post('/active_subcategory/{id}', 'ActiveSubCategory');
        Route::post('/inactive_subcategory/{id}', 'InactiveSubCategory');
        Route::get('/delete_subcategory/{id}', 'DeleteSubCategory');
    });

    // Product CRUD PART
    Route::controller(ProductController::class)->group(function () {
        Route::get('all/product', 'AllProduct')->name('all_product');
        Route::get('/view/product/', 'ShowProduct');
        Route::get('add/product', 'AddProduct')->name('add_product');
        Route::get('/subcategory/values/{cat_id}', 'ShowSubCategory');
        Route::post('/store/products', 'StoreProduct')->name('store_products');
        Route::get('/delete/product/{id}', 'DeleteProduct');
        Route::get('/active/product/{id}', 'ActiveProduct');
        Route::get('/inactive/product/{id}', 'InactiveProduct');

        Route::get('/edit/product/{id}', 'EditProduct');
        Route::post('/update/products/{id}', 'UpdateProduct')->name('update_products');

        Route::post('/update/mainThumbnail/{id}', 'UpdateMainThumbnail')->name('update_mainThumbnail');
        Route::post('/update/multiImages/{id}', 'UpdateMultiImages')->name('update_multiImages');
        Route::get('/delete/multiImages/{id}', 'DeleteMultiImages')->name('delete_multi_images');
    });

    // Slider Portion CRUD
    Route::controller(SliderController::class)->group(function () {
        Route::get('all/slider/', 'AllSlider')->name('all.slider');
        Route::post('/add_slider/', 'AddSlider');
        Route::get('/show_slider/', 'ShowSlider');
        Route::get('/delete_slider/{id}', 'DeleteSlider');
        Route::get('/edit_slider/{id}', 'EditSlider');
        Route::post('/update_slider/{id}', 'UpdateSlider');
        Route::get('/active_slider/{id}', 'ActiveSlider');
        Route::get('/inactive_slider/{id}', 'InactiveSlider');
    });

    // Banner Portion CRUD
    Route::controller(BannerController::class)->group(function () {
        Route::get('all/banner/', 'AllBanner')->name('all.banner');
        Route::post('/add_banner/', 'AddBanner');
        Route::get('/show_banner/', 'ShowBanner');
        Route::get('/delete_banner/{id}', 'DeleteBanner');
        Route::get('/edit_banner/{id}', 'EditBanner');
        Route::post('/update_banner/{id}', 'UpdateBanner');
        Route::get('/active_banner/{id}', 'ActiveBanner');
        Route::get('/inactive_banner/{id}', 'InactiveBanner');
    });

    // Banner Portion CRUD
    Route::controller(CouponController::class)->group(function () {
        Route::get('all/coupon/', 'AllCoupon')->name('all.coupon');
        Route::post('/add_coupon/', 'AddCoupon');
        Route::get('/show_coupon/', 'ShowCoupon');
        Route::post('/inactive_coupon/{id}', 'InactiveCoupon');
        Route::post('/active_coupon/{id}', 'ActiveCoupon');
        Route::get('/delete_coupon/{id}', 'DeleteCoupon');
        Route::get('/edit_coupon/{id}', 'EditCoupon');
        Route::post('/update_coupon/{id}', 'UpdateCoupon');
    });

    // Shipping Location Portion CRUD
    Route::controller(shippingController::class)->group(function () {
        Route::get('all/division/', 'AllDivision')->name('all.division');
        Route::post('/division_add/', 'InsertDivision');
        Route::get('/show_division/', 'ShowDivision');
        Route::post('/inactive_division/{id}', 'InActive');
        Route::post('/active_division/{id}', 'Active');
        Route::get('/delete_division/{id}', 'DeleteDivision');
        Route::get('/edit_division/{id}', 'EditDivision');
        Route::post('/update_division/{id}', 'UpdateDivision');


        Route::get('all/district/', 'AllDistrict')->name('all.district');
        Route::get('/get_division_data/', 'ShowAllDivision');
        Route::post('/district_add/', 'DistrictAdd');
        Route::get('/show_district/', 'ShowDistrict');
        Route::post('/inactive_district/{id}', 'InactiveDistrict');
        Route::post('/active_district/{id}', 'ActiveDistrict');
        Route::get('/delete_district/{id}', 'DeleteDistrict');


        Route::get('all/state/', 'AllState')->name('all.state');
        Route::get('/get_district_data/', 'ShowAllDistrict');
        Route::post('/state_add/', 'StateAdd');
        Route::get('/show_state/', 'ShowState');
        Route::post('/inactive_state/{id}', 'Inactivetate');
        Route::post('/active_state/{id}', 'ActiveState');
        Route::get('/delete_state/{id}', 'DeleteState');
    });

    Route::controller(ProductOrderManagement::class)->group(function () {
        // Table Data Show
        Route::get('pending/order/manage', 'PendingProductManage')->name('Pending.order.manage');
        Route::get('confirm/order/manage', 'ConfirmProductManage')->name('Confirm.order.manage');
        Route::get('processing/order/manage', 'ProcessingProductManage')->name('Processing.order.manage');
        Route::get('delivered/order/manage', 'DeliveredProductManage')->name('Delivered.order.manage');
        // End Table Data Show

        // Pending To Confirm Order 
        Route::get('pending/order/{order_id}', 'PendingStatusPage')->name('pending.order');
        Route::get('pending/confirm/order/{order_id}', 'PendingToConfirm');

        // Confirm To Processing Order
        Route::get('confirmed/order/{order_id}', 'ConfirmedStatusPage')->name('confirm.order');
        Route::get('confirmed/processing/order/{order_id}', 'ConfirmedToProcessing');

        // Processing To Delivered
        Route::get('processing/order/{order_id}', 'ProcessingStatusPage')->name('processing.order');
        Route::get('processing/delivered/order/{order_id}', 'ProcessingToDelivered');

        // Admin Invoice Download
        Route::get('admin/order/invoice/{order_id}', 'AdminOrderInvoiceDownload')->name('admin.order.invoice');
    });
    Route::controller(CancelReturnProductController::class)->group(function () {
        // Cancel Order
        Route::get('cancel/order/manage', 'CancelOrderManage')->name('cancel.order.manage');
        Route::get('confirm/cancel/order/manage', 'ConfirmManageList')->name('Confirm.canceled.order.manage');
        // Pending cancel To Confirm Cancel Order 
        Route::get('/pending/cancel/order/{order_id}', 'PendingCancelOrder')->name('pending.cancel.order');
        Route::get('/pending/cancel/confirm/order/{order_id}', 'ConfirmCancelOrder');
        Route::get('/delete/canceled/{order_id}', 'CancelDeleteOrder')->name('delete.canceled.order');

        // Return Order
        Route::get('return/order/manage', 'ReturnOrderManage')->name('return.order.manage');
        Route::get('confirm/return/order/manage', 'ConfirmReturnManageList')->name('Confirm.returned.order.manage');
        // Pending cancel To Confirm Cancel Order 
        Route::get('/pending/return/order/{order_id}', 'PendingReturnOrder')->name('pending.return.order');
        Route::get('/pending/return/confirm/order/{order_id}', 'ConfirmReturnOrder');
        Route::get('/delete/returned/{order_id}', 'ReturnDeleteOrder')->name('delete.returned.order');
    });
    Route::controller(OrderReporsManageController::class)->group(function () {
        // User Order Reports
        Route::get('/user/order/search/', 'UserOrderShow')->name('user.order.search');
        Route::get('/search/order/Bydates/', 'SearchOrderDates')->name('search.order.byDates');
        Route::get('/user/order/info/search/{search}', 'UserOrderInfo');

        // user order using date
        Route::get('/user/order/info/fulldate/{fulldate}', 'UserOrderFullDate');
        Route::get('/user/order/info/month/{month}', 'UserOrderMonthDate');
        Route::get('/user/order/info/year/{year}', 'UserOrderYearDate');
    });
    Route::controller(UserStatusController::class)->group(function () {
        // User Order Reports
        Route::get('/all/normal/users/', 'NormalUsersStatus')->name('all.normal.users');
        // Route::get('/all/users/status', 'UsersStatus');
        Route::get('/all/vendors/', 'VendorStatus')->name('all.vendors');
    });
    Route::controller(BlogController::class)->group(function () {
        // Blog category
        Route::get('/all/blog/category/', 'BlogCategory')->name('blog.category');
        Route::post('/add_category/blog/', 'AddBlogCategory');
        Route::get('/show_category/blog/', 'ShowBlogCategory');
        Route::post('/inactive_category/blog/{id}', 'InactiveBlogCategory');
        Route::post('/active_category/blog/{id}', 'ActiveBlogCategory');
        Route::get('/delete_category/blog/{id}', 'DeleteBlogCategory');
        Route::get('/edit_category/blog/{id}', 'EditBlogCategory');
        Route::post('/update_category/blog/{id}', 'UpdateBlogCategory');



        // Blog post
        Route::get('/all/blog/post', 'BlogPosts')->name('blog.post');
        Route::get('/add/blog/post', 'AddBlogPosts')->name('add.blog.post');
        Route::post('/store/blog/post', 'StoreBlogPosts')->name('store_blogs');
        Route::get('/active/blog/post/{id}', 'ActiveBlogPosts')->name('active.post');
        Route::get('/inactive/blog/post/{id}', 'InactiveBlogPosts')->name('inactive.post');
        Route::get('/delete/blog/post/{id}', 'DeleteBlogPosts')->name('delete.post');
        Route::get('/edit/blog/post/{id}', 'EditeBlogPosts')->name('edit.post');
        Route::post('update/store/blog/post/{id}', 'UpdateStoreBlogPosts')->name('update_store_blogs');
    });
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/active/review/product/', 'ActiveReviewProduct')->name('active.review.products');
        Route::get('/inactive/review/product/', 'InactiveReviewProduct')->name('inactive.review.products');
        Route::get('/active/product/{id}', 'ActiveProduct')->name('active.product');
        Route::get('/inactive/product/{id}', 'InactiveProduct')->name('inactive.product');
    });
    Route::controller(SiteSettingsController::class)->group(function () {
        Route::get('/company/site/settings/', 'CompanySiteSettings')->name('company.site.settings');
        Route::post('/company/update/', 'CompanyUpdate')->name('company.update');
        Route::get('/admin/site/settings/', 'AdminSiteSettings')->name('admin.site.settings');
        Route::get('/vendor/site/settings/', 'VendorSiteSettings')->name('vendor.site.settings');
        Route::get('/seo/settings/', 'seoSettings')->name('seo.settings');
        Route::post('/seo/settings/update/', 'seoSettingsUpdate')->name('seo.settings.update');
    });
    Route::controller(RoleController::class)->group(function () {
        /////////////////// All PERMISSIONS ////////////////////
        Route::get('/all/permission/', 'AllPermissions')->name('all.permission');
        Route::get('/add/permission/', 'AddPermission')->name('add.permission');
        Route::post('/store/permission/', 'StorePermission')->name('store.permission');

        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

        /////////////////// All Roles ////////////////////

        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');


        // Add Permissions into Roles
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'AdminRolesEdit')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}', 'AdminRolesDelete')->name('admin.delete.roles');
    });
});

// Admin + Vendor + User + Register part
Route::get('/admin/login', [adminController::class, 'AdminLogin'])->name('admin.adminLogin')->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [vendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [vendorController::class, 'BecomeVendor'])->name('become.vendor')->middleware(RedirectIfAuthenticated::class);
Route::post('/register/vendor', [vendorController::class, 'RegisterVendor'])->name('register.vendor')->middleware(RedirectIfAuthenticated::class);

// Social Login
Route::controller(SocialLoginAPIController::class)->group(function () {
    // Google Login + Registration
    Route::get('/gotoGoogle', 'goToGoogle')->name('gotogoogle');
    Route::get('/Gstore', 'storeGoogleData');
    Route::post('/setPassword{sid}', 'setPassword')->name('set.password');
    // Facebook Login + Registration
    Route::get('/gotoFacebook', 'goToFacebook')->name('gotofacebook');
    Route::get('/facebook/login/callbacks/', 'storeFacebookData');
    // GITHUB Login + Registration
    Route::get('/gotoGithub', 'goToGithub')->name('gotogithub');
    Route::get('/github/callbacks/', 'storeGithubData');
});


// Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::controller(vendorController::class)->group(function () {
        Route::get('/vendor/dashboard', 'vendorDashboard')->name('vendor.dashboard');
        Route::get('/vendor/logout', 'vendorDestroy')->name('vendor.logout');
        Route::get('/vendor/profile', 'vendorProfile')->name('vendor.profile');
        Route::post('/vendor/profile/store', 'vendorProfileStore')->name('vendor.profile.store');
        Route::get('/vendor/password/change', 'vendorPasswordChange')->name('vendor.vendor_password_change');
        Route::post('/vendor/password/update', 'vendorPasswordUpdate')->name('vendor.vendor_password_update');
    });
    // Vendor Product CRUD
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/all/product/vendor/', 'AllProductVendor')->name('all_product_vendor');
        Route::get('/view/product/vendor/', 'ShowProductVendor');

        Route::get('add/product/vendor/', 'AddProductVendor')->name('add_product_vendor');
        Route::get('/subcategory/values/vendor/{cat_id}', 'ShowSubCategoryVendor');
        Route::post('/store/products/vendor/', 'StoreProductVendor')->name('store_products_vendor');

        Route::get('/delete/product/vendor/{id}', 'DeleteProductVendor');
        Route::get('/active/product/vendor/{id}', 'ActiveProductVendor');
        Route::get('/inactive/product/vendor/{id}', 'InactiveProductVendor');

        Route::get('/edit/product/vendor/{id}', 'EditProductVendor');
        Route::post('/update/products/vendor/{id}', 'UpdateProductVendor')->name('update_products_vendor');

        Route::post('/update/mainThumbnail/vendor/{id}', 'UpdateMainThumbnailVendor')->name('update_mainThumbnail_vendor');
        Route::post('/update/multiImages/vendor/{id}', 'UpdateMultiImagesVendor')->name('update_multiImages_vendor');
        Route::get('/delete/multiImages/vendor/{id}', 'DeleteMultiImagesVendor')->name('delete_multi_images_vendor');
    });


    Route::controller(ProductOrderManagement::class)->group(function () {
        Route::get('/vendor/product/orders/', 'VendorOrder')->name('all.vendorOrders');
        Route::get('/vendor/user/orders/info/show/{id}', 'VendorUserOrderInfo')->name('vendor.userOrderInfo');
    });
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/all/product/review/', 'ProductReviewVendor')->name('all.products.review');
    });
});

// User Dashboard

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
        Route::get('/index/logout', [UserController::class, 'UserDestroy'])->name('user.logout');
        Route::post('/dashboard', [UserController::class, 'UserPasswordUpdate'])->name('user.user_password_update');
    });

    // Product Details Page
    // Route::controller(ProductDetails::class)->group(function () {
    //     Route::get('product/details/{id}/{slug}', 'ProductDetails');
    //     Route::get('category/product/{id}/{slug}', 'CategoryProduct');
    //     Route::get('subcategory/product/{id}/{slug}', 'SubCategoryProduct');
    //     Route::get('/product/modal/view/{id}', 'ProductModalView');
    // });

    // WishList Part
    Route::controller(WishlistController::class)->group(function () {
        Route::post('/product/addToWishList/{product_id}', 'InsertWishList');
        Route::get('shop/wishlist/', 'viewWishList')->name('shop_wishlist');
        Route::get('/all/wishlist/', 'wishListAjax');
        Route::get('/wish/product/remove/{id}', 'wishProductRemove');
    });

    // Compared Product
    Route::controller(CompareProductController::class)->group(function () {
        Route::get('all/product/compare/', 'productComparePage')->name('product_compare');
        Route::post('/product/compare/{product_id}', 'InsertProductCompare');
        Route::get('/show/compare/product/', 'ShowCompareProduct');
        Route::get('/compare/product/remove/{id}', 'CompareProductRemove');
    });

    // Cart Functionality
    Route::controller(CartController::class)->group(function () {
        Route::post('/cart/data/store/{id}', 'AddToCart');
        Route::post('/cart/data/store/wish/{id}', 'AddToCartWish');
        Route::post('/cart/data/store/compare/{id}', 'AddToCartCompare');

        Route::get('/product/mini/cart/', 'AddToMiniCart');
        Route::get('/cart/product/remove/{id}', 'CartProductRemove');

        Route::post('/main/cart/store/{id}', 'AddToCartMainPage');
        Route::get('/main/cart/page/', 'IndexCartPage')->name('cart-page');
        Route::get('/all/cart/products/', 'AddToMiniCart');
        Route::get('/increment_quantity/{id}', 'QuantityIncrement');
        Route::get('/decrement_quantity/{id}', 'QuantityDecrement');
        Route::get('/main/cart/remove/{id}', 'CartProductRemove');

        Route::post('/apply_coupon', 'CouponApply');
        Route::get('/coupon_calculation', 'CouponCalculation');
        Route::get('/coupon-remove', 'CouponRemove');

        // Checkout Page
        Route::get('/checkout/', 'CheckoutPageCreate')->name('checkoutPage');
    });

    // Shipping Info
    Route::controller(ShippingProductController::class)->group(function () {
        Route::get('/get_district_data/{id}', 'GetDistrict');
        Route::get('/get_state_data/{id}', 'GetState');
        Route::post('/checkout/store/payment/', 'CheckoutStorePayment')->name('checkout_store_payment');
    });
    // Stripe Portion
    Route::controller(StripeController::class)->group(function () {
        Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
        Route::post('/cod/order', 'CodOrder')->name('cod.order');
    });
    // User Dashboard
    Route::controller(AllUserController::class)->group(function () {
        Route::get('/user/account/page/', 'UserAccountPage')->name('user.account.page');
        Route::get('/user/order/page/', 'UserOrderPage')->name('user.order.page');
        Route::get('/user/track/order/page/', 'UserTrackOrderPage')->name('user.trackOrder.page');
        Route::post('/user/track/order/details/', 'UserTrackDetails')->name('user.trackOrder.details');
        Route::get('/user/billingShipping/page/', 'UserBillingShippingPage')->name('user.billing&Shipping.page');
        Route::get('/user/changePassword/page/', 'UserChangePasswordPage')->name('user.changePassword.page');
        Route::get('/user/orderDetails/page/{order_id}', 'UserOrderDetailsPage');
        Route::get('/user/orderInvoice/page/{order_id}', 'UserOrderInvoicePage');

        // Cancel & Return Order
        Route::get('user/cancel&Return/order/page', 'CancelReturn')->name('user.cancel&return.order.page');
        Route::post('/cancel/order/{order_id}', 'cancelOrder')->name('cancel.order');
        Route::post('/return/order/{order_id}', 'returnOrder')->name('return.order');
    });
    Route::controller(ReviewController::class)->group(function () {
        Route::post('/store/product/review/', 'StoreProductReview')->name('store.product.review');
    });
});

Route::controller(ProductDetails::class)->group(function () {
    Route::get('product/details/{id}/{slug}', 'ProductDetails');
    Route::get('category/product/{id}/{slug}', 'CategoryProduct');
    Route::get('subcategory/product/{id}/{slug}', 'SubCategoryProduct');
    Route::get('/product/modal/view/{id}', 'ProductModalView');

    Route::post('/search/product/', 'SearchProduct')->name('search.product');
    Route::get('/show/search/result', 'showResults')->name('show.results');
    Route::post('/search-product', 'SearchProductAjax');
});

Route::controller(BlogDetailsListController::class)->group(function () {
    Route::get('/blog/page/show/', 'BlogPageShow')->name('blog.page.show');
    Route::get('blog/details/{id}/{slug}', 'DetailsBlogPage');
});

Route::controller(ShopFilterController::class)->group(function () {
    Route::get('/shop/page/', 'ShopIndex')->name('shop.page');
    Route::post('/shop/filter/page/', 'ShopFilter')->name('shop.filter');
});

Route::get('/vendor/details/{id}', [VendorDetailsController::class, 'VendorDetails'])->name('vendorDetailsInfo');
Route::get('vendor/list/', [VendorListGridController::class, 'VendorList'])->name('vendor_list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
