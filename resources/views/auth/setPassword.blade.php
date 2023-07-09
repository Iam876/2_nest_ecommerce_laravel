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
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        {{-- <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="{{asset('frontend')}}/assets/imgs/page/login-1.png" alt="" />
                        </div> --}}
                        <div class="col-lg-8 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Set your password</h1>
                                        <p class="mb-30">These are mandatory field. Without this you can't access your account !!</a></p>
                                    </div>
                                    <form id="setPasswordForm" method="POST" action="{{ route('set.password',$sid) }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="name" type="text" required="" name="name" placeholder="name" />
                                    </div>
                                    <div class="form-group" id="misMatched1">
                                        <input required="" type="password" id="password" name="password" placeholder="Password" />
                                    </div>
                                    <div id="erroMessage1"></div>
                                    <div class="form-group" id="misMatched2">
                                        <input required="" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" />
                                    </div>
                                    <div id="erroMessage2"></div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
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

<style>
    .error_not_matched{
        border: 1px solid red;
        border-radius: 10px;
    }
    .erroMessage{
        color: red;
        font-size:12px;
        margin-top: -15px;
    }
</style>

<script>
    document.getElementById('setPasswordForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let password = document.getElementById('password').value;
        let confirmPassword = document.getElementById('password_confirmation').value;
        let misMatched1 = document.getElementById('misMatched1');
        let misMatched2 = document.getElementById('misMatched2');
        let erroMessage1 = document.getElementById('erroMessage1');
        let erroMessage2 = document.getElementById('erroMessage2');
        if (password !== confirmPassword) {
            misMatched1.classList.add('error_not_matched');
            misMatched2.classList.add('error_not_matched');
            erroMessage1.classList.add('erroMessage');
            erroMessage2.classList.add('erroMessage');
            erroMessage1.innerHTML = 'Password and Confirm password do not match';
            erroMessage2.innerHTML = 'Password and Confirm password do not match';
            // alert('Password and Confirm password do not match');
        } else {
            misMatched1.classList.remove('error_not_matched');
            misMatched2.classList.remove('error_not_matched');
            erroMessage1.classList.remove('erroMessage');
            erroMessage2.classList.remove('erroMessage');
            erroMessage1.innerHTML = '';
            erroMessage2.innerHTML = '';
            this.submit();
        }
    });
</script>
@include('frontend.layouts.footer')