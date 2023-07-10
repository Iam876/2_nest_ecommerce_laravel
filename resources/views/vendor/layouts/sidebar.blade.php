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
					<a href="{{Route('vendor.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				@php
			$id = Auth::user()->id;
			$vendorId = App\Models\User::find($id);
			$status = $vendorId->status;
		@endphp
			@if($status=='active')
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Products</div>
					</a>
					<ul>
						<li> <a href="{{Route('all_product_vendor')}}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
						</li>
						<li> <a href="{{Route('add_product_vendor')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Order Details</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Order Manage</div>
					</a>
					<ul>
						<li> <a href="{{Route('all.vendorOrders')}}"><i class="bx bx-right-arrow-alt"></i>Vendor Order</a>
						</li>
					</ul>
				</li>
			@else
			@endif

			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->