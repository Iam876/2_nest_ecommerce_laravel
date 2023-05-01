@include('frontend.layouts.header')
    <!-- Modal -->
    <!-- Header  -->
    @include('frontend.layouts.menuBar')
   <!-- End Header  -->
    <!-- Mobile Header -->
   @include('frontend.layouts.mobileHeader')
    <!--End header-->
    <main class="main">
      @yield('dashboard')
    </main>
@include('frontend.layouts.footer')