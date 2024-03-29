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
        <!--End header-->

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            <p class="mb-30">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                                        </div>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input id="name" type="text" required="" name="name" placeholder="name" />
                                            </div>
                                            <div class="form-group">
                                                <input id="username" type="text" required="" name="username" placeholder="username" />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" required="" id="email" name="email" placeholder="Email" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" id="password" name="password" placeholder="Password" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" />
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="register">Submit &amp; Register</button>
                                            </div>
                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="{{route('gotofacebook')}}" class="social-login facebook-login">
                                        <img src="{{asset('frontend')}}/assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="{{route('gotogoogle')}}" class="social-login google-login">
                                        <img src="{{asset('frontend')}}/assets/imgs/theme/icons/logo-google.svg" alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="{{route('gotogithub')}}" class="social-login apple-login">
                                        <img src="{{asset('frontend')}}/assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                        <span>Continue with Github</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('frontend.layouts.footer')