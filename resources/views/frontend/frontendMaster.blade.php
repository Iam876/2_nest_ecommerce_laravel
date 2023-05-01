@include('frontend.layouts.header')
    <!-- Modal -->
    <!-- Quick view -->
    @include('frontend.layouts.productModalView')
    <!-- Header  -->
    @include('frontend.layouts.menuBar')
   <!-- End Header  -->
    <!-- Mobile Header -->
   @include('frontend.layouts.mobileHeader')
    <!--End header-->
    <main class="main">
      @yield('main-section')
    </main>
@include('frontend.layouts.footer')