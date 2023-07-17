<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    @php
        $seo = App\Models\Seo\SeoSettings::find(1);
    @endphp
    
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="title" content="{{$seo->meta_title}}" />
    <meta name="author" content="{{$seo->meta_author}}" />
    <meta name="keyword" content="{{$seo->meta_keyword}}" />
    <meta name="description" content="{{$seo->meta_description}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/main.css?v=5.3" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>