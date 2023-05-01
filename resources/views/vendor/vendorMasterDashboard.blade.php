@include('vendor.layouts.header')
    @include('vendor.layouts.sidebar')
		@include('vendor.layouts.topbar')

			<div class="page-wrapper">
				@yield('main-content')
			</div>

@include('vendor.layouts.footer')
