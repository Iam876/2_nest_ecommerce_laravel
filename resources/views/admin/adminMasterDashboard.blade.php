@include('admin.layouts.header')
    @include('admin.layouts.sidebar')
		@include('admin.layouts.topbar')

			<div class="page-wrapper">
				@yield('main-content')
			</div>

@include('admin.layouts.footer')
