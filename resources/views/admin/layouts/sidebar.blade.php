<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('adminBackend')}}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Rukada</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{Route('admin.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li> <a href="{{Route('all.brand')}}"><div class="parent-icon"><i class="bx bx-category"></i></div>
				<div class="menu-title">Brand</div>
			</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Category</div>
					</a>
					<ul>
						<li> <a href="{{Route('all.category')}}"><i class="bx bx-right-arrow-alt"></i>Category</a>
						</li>
						<li> <a href="{{Route('all.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>SubCategory</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Products</div>
					</a>
					<ul>
						<li> <a href="{{Route('all_product')}}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
						</li>
						<li> <a href="{{Route('add_product')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-slider"></i>
						</div>
						<div class="menu-title">Slider</div>
					</a>
					<ul>
						<li> <a href="{{Route('all.slider')}}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-banner"></i>
						</div>
						<div class="menu-title">Banner</div>
					</a>
					<ul>
						<li> <a href="{{Route('all.banner')}}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">Coupon</div>
					</a>
					<ul>
						<li> <a href="{{route('all.coupon')}}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">Shipping</div>
					</a>
					<ul>
						<li> <a href="{{route('all.division')}}"><i class="bx bx-right-arrow-alt"></i>All Division</a>
						</li>
						<li> <a href="{{route('all.district')}}"><i class="bx bx-right-arrow-alt"></i>All District</a>
						</li>
						<li> <a href="{{route('all.state')}}"><i class="bx bx-right-arrow-alt"></i>All State</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Delivery</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">Order Manage</div>
					</a>
					<ul>
						<li> <a href="{{route('Pending.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
						</li>
						<li> <a href="{{route('Confirm.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Confirm Order</a>
						</li>
						<li> <a href="{{route('Processing.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
						<li> <a href="{{route('Delivered.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">Cancel Order</div>
					</a>
					<ul>
						<li> <a href="{{route('cancel.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Pending Cancel Order</a>
						</li>
						<li> <a href="{{route('Confirm.canceled.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Canceled Order</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">Return Order</div>
					</a>
					<ul>
						<li> <a href="{{route('return.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Pending Return Order</a>
						</li>
						<li> <a href="{{route('Confirm.returned.order.manage')}}"><i class="bx bx-right-arrow-alt"></i>Return Order</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Vendor</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Vendors</div>
					</a>
					<ul>
						<li> <a href="{{route('inactive.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
						</li>
						<li> <a href="{{route('active.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
						</li>
						<!-- <li> <a href="ecommerce-add-new-products.html"><i class="bx bx-right-arrow-alt"></i>Add New Products</a>
						</li>
						<li> <a href="ecommerce-orders.html"><i class="bx bx-right-arrow-alt"></i>Orders</a>
						</li> -->
					</ul>
				</li>
				<li class="menu-label">Reports</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Reports</div>
					</a>
					<ul>
						<li> <a href="{{Route('user.order.search')}}"><i class="bx bx-right-arrow-alt"></i>User Order</a>
						</li>
						<li> <a href="{{Route('search.order.byDates')}}"><i class="bx bx-right-arrow-alt"></i>Order By Dates</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">User & Vendor Status</li>
				<li>
					<a href="{{Route('all.normal.users')}}">
						<div class="parent-icon"><i class="bx bx-line-chart"></i>
						</div>
						<div class="menu-title">Users</div>
					</a>
				</li>
				<li>
					<a href="{{Route('all.vendors')}}">
						<div class="parent-icon"><i class="bx bx-map-alt"></i>
						</div>
						<div class="menu-title">Vendors</div>
					</a>
				</li>
				<li class="menu-label">Blog Manage</li>
				<li>
					<a href="{{Route('blog.category')}}">
						<div class="parent-icon"><i class="bx bx-line-chart"></i>
						</div>
						<div class="menu-title">Blog Category</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">Blog</div>
					</a>
					<ul>
						<li> <a href="{{Route('add.blog.post')}}"><i class="bx bx-right-arrow-alt"></i>Add Blog</a>
						</li>
						<li> <a href="{{Route('blog.post')}}"><i class="bx bx-right-arrow-alt"></i>All Blog</a>
						</li>
						<li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Pending Blog</a>
						</li>

					</ul>
				</li>
				<li class="menu-label">Review Manage</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">Product Review</div>
					</a>
					<ul>
						<li> <a href="{{Route('active.review.products')}}"><i class="bx bx-right-arrow-alt"></i>Active Review</a>
						</li>
						<li> <a href="{{Route('inactive.review.products')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Review</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Site Settings</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-coupon"></i>
						</div>
						<div class="menu-title">All Site Settings</div>
					</a>
					<ul>
						<li> <a href="{{Route('company.site.settings')}}"><i class="bx bx-right-arrow-alt"></i>Ecommerce Site Settings</a>
						</li>
						<li> <a href="{{Route('admin.site.settings')}}"><i class="bx bx-right-arrow-alt"></i>Admin Settings</a>
						</li>
						<li> <a href="{{Route('vendor.site.settings')}}"><i class="bx bx-right-arrow-alt"></i>Vendor Settings</a>
						</li>
						<li> <a href="{{Route('seo.settings')}}"><i class="bx bx-right-arrow-alt"></i>Seo Settings</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->