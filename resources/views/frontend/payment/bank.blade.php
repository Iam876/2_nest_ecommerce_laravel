@extends('frontend.frontendMaster')
    <!--End header-->
@section('main-section')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> 
                <span></span> Bank Payment
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Bank Payment</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">Make your payment in most secured way with us!!!</h6>
                </div>
            </div>
        </div>
<div class="row">
<div class="col-lg-6">
    <div class="border p-40 cart-totals ml-30 mb-50">
        <div class="d-flex align-items-end justify-content-between mb-30">
            <h4>Your Order</h4>
            <h6 class="text-muted">Subtotal</h6>
        </div>
        <div class="divider-2 mb-30"></div>
        <div class="table-responsive order_table checkout">
            <table class="table no-border">
                <tbody>
                </tbody>
            </table>

            <table class="table no-border">
            <tbody>
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Subtotal</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$12.31</h4>
                    </td>
                </tr>
                
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Coupn Name</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h6 class="text-brand text-end">EASYLEA</h6>
                    </td>
                </tr>

                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Coupon Discount</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$12.31</h4>
                    </td>
                </tr>

                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Grand Total</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$12.31</h4>
                    </td>
                </tr>
            </tbody>
            </table>





        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="border p-40 cart-totals ml-30 mb-50">
        <div class="d-flex align-items-end justify-content-between mb-30">
            <h4>Your Order</h4>
            <h6 class="text-muted">Subtotal</h6>
        </div>
        <div class="divider-2 mb-30"></div>
        <div class="table-responsive order_table checkout">
            <table class="table no-border">
                <tbody>
                </tbody>
            </table>

            <table class="table no-border">
            <tbody>
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Subtotal</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$12.31</h4>
                    </td>
                </tr>
                
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Coupn Name</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h6 class="text-brand text-end">EASYLEA</h6>
                    </td>
                </tr>

                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Coupon Discount</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$12.31</h4>
                    </td>
                </tr>

                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Grand Total</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$12.31</h4>
                    </td>
                </tr>
            </tbody>
            </table>





        </div>
    </div>
                <div class="payment ml-30">
                    <h4 class="mb-30">Payment</h4>
                    <div class="payment_option">
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                            <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Direct Bank Transfer</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                            <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                        </div>
                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="assets/imgs/theme/icons/payment-paypal.svg" alt="">
                        <img class="mr-15" src="assets/imgs/theme/icons/payment-visa.svg" alt="">
                        <img class="mr-15" src="assets/imgs/theme/icons/payment-master.svg" alt="">
                        <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">
                    </div>
                    <a href="#" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection