@extends('frontend.frontendMaster')
    <!--End header-->
    @section('main-section')
    <main class="main">
        <!-- Home Hero Slider -->
        @include('frontend.layouts.homeHeroSlider')
        <!--End hero slider-->
        @include('frontend.layouts.popularCategory')
        
        <!--End category slider-->
        @include('frontend.layouts.banners')
        <!--End banners-->
        @include('frontend.layouts.productTable')
        <!--Products Tabs-->
        @include('frontend.layouts.featuredProduct')
        <!--End Best Sales-->
        <!-- TV Category -->
        @include('frontend.layouts.tvCategory')
        <!--End TV Category -->
        <!-- Tshirt Category -->
        @include('frontend.layouts.tshirtCategory')
        <!--End Tshirt Category -->
        <!-- Computer Category -->
        @include('frontend.layouts.computerCategory')
        <!--End Computer Category -->
        @include('frontend.layouts.recentDealOffer')

        <!--End 4 columns-->

        <!--Vendor List -->
        @include('frontend.layouts.vendorList')
        <!--End Vendor List -->
    </main>
    @endsection


    