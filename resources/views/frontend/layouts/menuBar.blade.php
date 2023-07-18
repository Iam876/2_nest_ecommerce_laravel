@php
    $settings = App\Models\SiteSetting\SiteSetting::find(1);
@endphp
<style>
            .header-right .panel--search-result {
            border: 2px solid #BCE3C9;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            border-top: 0;
            left: -2px;
            width: calc(100% + 4px);
        }
        .panel--search-result.active {
            opacity: 1;
            transform: scaleX(1);
            visibility: visible;
        }
        .panel__footer{
            border-top: 1px solid #eee;
            padding: 5px 0px; 
        }
        .panel--search-result {
            background-color: #fff;
            border: 1px solid #eaeaea;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 100%;
            transform: scaleZ(0);
            transition: all .4s ease;
            visibility: hidden;
            width: 100%;
            z-index: 999;
        }
</style>
<header class="header-area header-style-1 header-height-2">
<div class="mobile-promotion">
<span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
</div>
<div class="header-top header-top-ptb-1 d-none d-lg-block">
<div class="container">
    <div class="row align-items-center">
        <div class="col-xl-3 col-lg-4">
            <div class="header-info">
                <ul>
                    
                    <li><a href="page-account.html">My Cart</a></li>
                    <li><a href="shop-wishlist.html">Checkout</a></li>
                    <li><a href="shop-order.html">Order Tracking</a></li>
                </ul>
            </div>
        </div>
        <div class="col-xl-6 col-lg-4">
            <div class="text-center">
                <div id="news-flash" class="d-inline-block">
                    <ul>
                        <li>100% Secure delivery without contacting the courier</li>
                        <li>Supper Value Deals - Save more with coupons</li>
                        <li>Trendy 25silver jewelry, save up 35% off today</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4">
            <div class="header-info header-info-right">
                <ul>
                    
                    <li>
                        <a class="language-dropdown-active" href="#">English <i class="fi-rs-angle-small-down"></i></a>
                        <ul class="language-dropdown">
                            <li>
                                <a href="#"><img src="{{asset('frontend')}}/assets/imgs/theme/flag-fr.png" alt="" />Français</a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('frontend')}}/assets/imgs/theme/flag-dt.png" alt="" />Deutsch</a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('frontend')}}/assets/imgs/theme/flag-ru.png" alt="" />Pусский</a>
                            </li>
                        </ul>
                    </li>

                        <li>Need help? Call Us : <strong class="text-brand"> {{$settings->phone_one}}</strong></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<div class="header-middle header-middle-ptb-1 d-none d-lg-block">
<div class="container">
    <div class="header-wrap">
        <div class="logo logo-width-1">
            <a href="{{url('/')}}"><img src="{{asset($settings->logo)}}" alt="logo" /></a>
        </div>
        <div class="header-right">
            <div class="search-style-2">
                <form action="{{route('search.product')}}" method="POST">
                    @csrf
                    <div class="position-relative">
                        <select class="select-active">
                            <option>All Categories</option>
                            <option>Milks and Dairies</option>
                            <option>Wines & Alcohol</option>
                            <option>Clothing & Beauty</option>
                            <option>Pet Foods & Toy</option>
                            <option>Fast food</option>
                            <option>Baking material</option>
                            <option>Vegetables</option>
                            <option>Fresh Seafood</option>
                            <option>Noodles & Rice</option>
                            <option>Ice cream</option>
                        </select>
                    </div>
                        <input id="SearchItems" name="search" placeholder="Search for items..." />
                    <div class="panel--search-result " id="SearchItemShow">
                        <div class="panel__footer text-center">
                            <a href="{{Route('search.product')}}">See all results</a>
                         </div>
                    </div>
                    
                </form>
            </div>
            <div class="header-action-right">
                <div class="header-action-2">
                    <div class="search-location">
                        <form action="#">
                            <select class="select-active">
                                <option>Your Location</option>
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>Arizona</option>
                                <option>Delaware</option>
                                <option>Florida</option>
                                <option>Georgia</option>
                                <option>Hawaii</option>
                                <option>Indiana</option>
                                <option>Maryland</option>
                                <option>Nevada</option>
                                <option>New Jersey</option>
                                <option>New Mexico</option>
                                <option>New York</option>
                            </select>
                        </form>
                    </div>
                    
                    <div class="header-action-icon-2">
                        <a href="{{route('product_compare')}}">
                            <img class="svgInject" alt="Nest" src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-heart.svg" />
                            <span class="pro-count blue" id="CompareCount">0</span>
                        </a>
                        <a href="{{route('product_compare')}}"><span class="lable">Compare</span></a>
                    </div>
                    <div class="header-action-icon-2">
                        <a href="{{route('shop_wishlist')}}">
                            <img class="svgInject" alt="Nest" src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-heart.svg" />
                            <span class="pro-count blue" id="wishCount">0</span>
                        </a>
                        <a href="{{route('shop_wishlist')}}"><span class="lable">Wishlist</span></a>
                    </div>
                    <div class="header-action-icon-2">
                        <a class="mini-cart-icon" href="{{Route('cart-page')}}">
                            <img alt="Nest" src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-cart.svg" />
                            <span class="pro-count blue" id="miniCart">0</span>
                        </a>
                        <a href="{{Route('cart-page')}}"><span class="lable">Cart</span></a>
                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                            <ul id="miniCartLists">
                                
                            </ul>
                            <div class="shopping-cart-footer">
                                <div class="shopping-cart-total">
                                    <h4>Total <span id="miniCartTotal"></span></h4>
                                </div>
                                <div class="shopping-cart-button">
                                    <a href="shop-cart.html" class="outline">View cart</a>
                                    <a href="shop-checkout.html">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-action-icon-2">
                        @auth
                        <a href="{{Route('user.dashboard')}}">
                            <img class="svgInject" alt="Nest" src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-user.svg" />
                        </a>
                        <a href="{{Route('user.dashboard')}}"><span class="lable ml-0">Account</span></a>
                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                            <ul>
                                <li>
                                    <a href="{{Route('user.dashboard')}}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                </li>
                                <li>
                                    <a href="{{Route('user.trackOrder.page')}}"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                </li>
                                <li>
                                    <a href="{{route('shop_wishlist')}}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                </li>
                                <li>
                                    <a href="{{Route('user.dashboard')}}"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                </li>
                                <li>
                                    <a href="{{Route('user.logout')}}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                </li>
                            </ul>
                        </div>
                        @else
                        <a href="{{Route('login')}}"><span class="lable ml-0">Login | </span></a>
                        <a href="{{Route('register')}}"><span class="lable ml-0">Register</span></a>                                    @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>








<div class="header-bottom header-bottom-bg-color sticky-bar">
<div class="container">
    <div class="header-wrap header-space-between position-relative">
        <div class="logo logo-width-1 d-block d-lg-none">
            <a href="index.html"><img src="{{asset('frontend')}}/assets/imgs/theme/logo.svg" alt="logo" /></a>
        </div>
        <div class="header-nav d-none d-lg-flex">
            <div class="main-categori-wrap d-none d-lg-block">
                <a class="categories-button-active" href="#">
                    <span class="fi-rs-apps"></span>   All Categories
                    <i class="fi-rs-angle-down"></i>
                </a>
                <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                    <div class="d-flex categori-dropdown-inner">
                        <ul>

                            @php
                            $categories = App\Models\Category\Category::orderBy('category_name','DESC')->where('status','active')->withCount('products')->limit(4)->get();
                            @endphp
                            @foreach($categories->slice(0) as $category)
                            <li>
                                <a href="#"> <img src="{{asset($category->category_image)}}" alt="" />{{$category->category_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                        <ul class="end">
                            @foreach($categories->slice(6) as $category)
                            <li>
                                <a href="shop-grid-right.html"> <img src="{{asset($category->category_image)}}" alt="" />{{$category->category_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="more_slide_open" style="display: none">
                        <div class="d-flex categori-dropdown-inner">
                            <ul>
                                @foreach($categories->slice(11,3) as $category)
                                    <li>
                                        <a href="{{url('category/product/'.$category->id.'/'.$category->category_slug)}}"> <img src="{{asset($category->category_image)}}" alt="" />{{$category->category_name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="end">
                                @foreach($categories->slice(14,3) as $category)
                                    <li>
                                        <a href="{{url('category/product/'.$category->id.'/'.$category->category_slug)}}"> <img src="{{asset($category->category_image)}}" alt="" />{{$category->category_name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
                </div>
            </div>
            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                <nav>
                    <ul>
                        
                        <li>
                            <a class="active" href="{{ url('/') }}">Home  </a>
                            
                </li>
                @foreach($categories as $category)
                <li>
                    <a href="{{url('category/product/'.$category->id.'/'.$category->category_slug)}}">{{$category->category_name}} <i class="fi-rs-angle-down"></i></a>
                    @php
                        $subcategories = App\Models\Subcategory\Subcategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                    @endphp
                    <ul class="sub-menu">
                        @foreach($subcategories as $subcategory)
                            <li><a href="{{url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug)}}">{{$subcategory->subcategory_name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                        <li>
                            <a href="{{Route('blog.page.show')}}">Blog</a>
                        </li>
                        <li>
                            <a href="page-contact.html">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


        <div class="hotline d-none d-lg-flex">
            <img src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-headphone.svg" alt="hotline" />
            <p>{{$settings->support_phone}}<span>24/7 Support Center</span></p>
        </div>
        <div class="header-action-icon-2 d-block d-lg-none">
            <div class="burger-icon burger-icon-white">
                <span class="burger-icon-top"></span>
                <span class="burger-icon-mid"></span>
                <span class="burger-icon-bottom"></span>
            </div>
        </div>
        <div class="header-action-right d-block d-lg-none">
            <div class="header-action-2">
                <div class="header-action-icon-2">
                    <a href="{{route('shop_wishlist')}}">
                        <img alt="Nest" src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-heart.svg" />
                        <span class="pro-count white">4</span>
                    </a>
                </div>
                <div class="header-action-icon-2">
                    <a class="mini-cart-icon" href="#">
                        <img alt="Nest" src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-cart.svg" />
                        <span class="pro-count white">2</span>
                    </a>
                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                        <ul>
                            <li>
                                <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-3.jpg" /></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                    <h3><span>1 × </span>$800.00</h3>
                                </div>
                                <div class="shopping-cart-delete">
                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-4.jpg" /></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                    <h3><span>1 × </span>$3500.00</h3>
                                </div>
                                <div class="shopping-cart-delete">
                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                </div>
                            </li>
                        </ul>
                        <div class="shopping-cart-footer">
                            <div class="shopping-cart-total">
                                <h4>Total <span>$383.00</span></h4>
                            </div>
                            <div class="shopping-cart-button">
                                <a href="shop-cart.html">View cart</a>
                                <a href="shop-checkout.html">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</header>