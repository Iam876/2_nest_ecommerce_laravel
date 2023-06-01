@extends('frontend.frontendMaster')
    <!--End header-->
@section('main-section')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand">3</span> products in your cart</h6>
                        <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" colspan="2" class="pl-30">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="mainCart">
                                
                            </tbody>
                        </table>
                    </div>
                   

                    <div class="row mt-50">

                        <div class="col-lg-5" >
                            <div class="p-40" id="couponField">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                
                                    <div class="d-flex justify-content-between">
                                        <input class="font-medium mr-15 coupon" id="coupon" placeholder="Enter Your Coupon">
                                        <button class="btn" id="apply_coupon"><i class="fi-rs-label mr-10"></i>Apply</button>
                                    </div>
                                 
                            </div>
                        </div>


                        <div class="col-lg-7">
                             <div class="divider-2 mb-30"></div>
                     


                            <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody id="CouponCalField">
                                    
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                        </div>


                    
                    </div>
                </div>
                 
            </div>
        </div>
    </main>
@endsection