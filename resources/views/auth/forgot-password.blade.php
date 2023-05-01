<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/main.css?v=5.3" />
</head>

<body>
 
<!-- Header  -->
@include('frontend.layouts.header')

   <!-- End Header  -->

   @include('frontend.layouts.mobileHeader')
    <!--End header-->
    @include('frontend.layouts.menuBar')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Forget Password
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                        <div class="row">
                            <div class="heading_s1">
                                <img class="border-radius-15" src="{{asset('frontend')}}/assets/imgs/page/reset_password.svg" alt="" />
                                <h2 class="mb-15 mt-15">Email password reset</h2>
                                <p class="mb-30">Enter your Email to reset your password.</p>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" required="" id="email" name="email" placeholder="Enter Email *" />
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Email Password Reset Link</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('frontend.layouts.footer')