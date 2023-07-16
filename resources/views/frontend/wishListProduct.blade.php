@extends('frontend.frontendMaster')
@section('title')
Wishlist Page
@endsection
    <!--End header-->
    @section('main-section')
        <main class="main">
            <div class="page-header breadcrumb-wrap">
                <div class="container">
                    <div class="breadcrumb">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Shop <span></span> Fillter
                    </div>
                </div>
            </div>
            <div class="container mb-30 mt-50">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <div class="mb-50">
                            <h1 class="heading-2 mb-10">Your Wishlist</h1>
                            <h6 class="text-body" id="wishListMessage">There are <span class="text-brand" id="totalProducts"></span> products in this list</h6>
                        </div>
                        <div class="table-responsive shopping-summery">
                            <table class="table table-wishlist">
                                <thead id="wishHead">
                                    
                                </thead>
                                <tbody id="WishShow">
                                

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection