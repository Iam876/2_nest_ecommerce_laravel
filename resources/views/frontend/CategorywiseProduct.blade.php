@extends('frontend.frontendMaster')
@section('title')
{{$categories->category_name}} Category
@endsection
    <!--End header-->
    @section('main-section')
<main class="main" style="transform: none;">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{$categories->category_name}}</h1>
                        <div class="breadcrumb">
                            <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Shop <span></span> {{$categories->category_name}}
                        </div>
                    </div>
                    {{-- <div class="col-xl-9 text-end d-none d-xl-block">
                        <ul class="tags-list">
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Cabbage</a>
                            </li>
                            <li class="hover-up active">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Broccoli</a>
                            </li>
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Artichoke</a>
                            </li>
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Celery</a>
                            </li>
                            <li class="hover-up mr-0">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Spinach</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30" style="transform: none;">
        <div class="row" style="transform: none;">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{$products->count()}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @if ($products->count() == 0)
                        <span class="text-danger">No Product Found</span>
                    @else
                    @foreach ($products as $product)
                    @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount / $product->selling_price)*100;
                    @endphp
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                        <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                        <img class="hover-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($product->discount_price == NULL)
                                    <span class="new">New</span>
                                @else
                                    <span class="hot">{{round($discount)}} %</span>
                                @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{$product->category->category_name}}</a>
                                </div>
                                <h2><a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{$product->product_name}}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    @if($product->vendor->name == NULL)
                                    <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                    @else
                                    <span class="font-small text-muted">By <a href="vendor-details-1.html">{{$product->vendor->name}}</a></span>
                                    @endif
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        @if ($product->discount_price == NULL)
                                        <span>{{$product->selling_price}} $</span>
                                @else
                                        <span>{{$product->discount_price}} $</span>
                                        <span class="old-price">{{$product->selling_price}} $</span>
                                @endif
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @endforeach
                    @endif
                    
                </div>
                <!--product grid-->
                {{-- <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div> --}}
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            {{-- Previous Page Link --}}
                            @if ($products->currentPage() > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="fi-rs-arrow-small-left"></i></a>
                                </li>
                            @endif
                
                            {{-- Pagination Elements --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page > 5)
                                    {{-- Show "..." if page number exceeds 5 --}}
                                    @if ($page === 6)
                                        <li class="page-item">
                                            <a class="page-link dot" href="#">...</a>
                                        </li>
                                    @endif
                                    @continue
                                @endif
                
                                <li class="page-item {{ $page === $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                
                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="fi-rs-arrow-small-right"></i></a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <section class="section-padding pb-5">
                    <div class="section-title">
                        <h3 class="">Deals Of The Day</h3>
                        <a class="show-all" href="shop-grid-right.html">
                            All Deals
                            <i class="fi-rs-angle-right"></i>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{asset('frontend')}}/assets/imgs/banner/banner-5.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"><span class="countdown-section"><span class="countdown-amount hover-up">675</span><span class="countdown-period"> days </span></span><span class="countdown-section"><span class="countdown-amount hover-up">07</span><span class="countdown-period"> hours </span></span><span class="countdown-section"><span class="countdown-amount hover-up">14</span><span class="countdown-period"> mins </span></span><span class="countdown-section"><span class="countdown-amount hover-up">35</span><span class="countdown-period"> sec </span></span></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Seeds of Change Organic Quinoa, Brown</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">NestFood</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$32.85</span>
                                                <span class="old-price">$33.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{asset('frontend')}}/assets/imgs/banner/banner-6.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"><span class="countdown-section"><span class="countdown-amount hover-up">1071</span><span class="countdown-period"> days </span></span><span class="countdown-section"><span class="countdown-amount hover-up">07</span><span class="countdown-period"> hours </span></span><span class="countdown-section"><span class="countdown-amount hover-up">14</span><span class="countdown-period"> mins </span></span><span class="countdown-section"><span class="countdown-amount hover-up">35</span><span class="countdown-period"> sec </span></span></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Perdue Simply Smart Organics Gluten</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Old El Paso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$24.85</span>
                                                <span class="old-price">$26.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-lg-block">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{asset('frontend')}}/assets/imgs/banner/banner-7.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2027/03/25 00:00:00"><span class="countdown-section"><span class="countdown-amount hover-up">1405</span><span class="countdown-period"> days </span></span><span class="countdown-section"><span class="countdown-amount hover-up">07</span><span class="countdown-period"> hours </span></span><span class="countdown-section"><span class="countdown-amount hover-up">14</span><span class="countdown-period"> mins </span></span><span class="countdown-section"><span class="countdown-amount hover-up">35</span><span class="countdown-period"> sec </span></span></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Signature Wood-Fired Mushroom</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Progresso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$12.85</span>
                                                <span class="old-price">$13.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-xl-block">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{asset('frontend')}}/assets/imgs/banner/banner-8.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2025/02/25 00:00:00"><span class="countdown-section"><span class="countdown-amount hover-up">647</span><span class="countdown-period"> days </span></span><span class="countdown-section"><span class="countdown-amount hover-up">07</span><span class="countdown-period"> hours </span></span><span class="countdown-section"><span class="countdown-amount hover-up">14</span><span class="countdown-period"> mins </span></span><span class="countdown-section"><span class="countdown-amount hover-up">35</span><span class="countdown-period"> sec </span></span></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Simply Lemonade with Raspberry Juice</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Yoplait</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$15.85</span>
                                                <span class="old-price">$16.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                
                <!-- Fillter By Price -->
                
                <!-- Product sidebar Widget -->
                
                
            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 1446.5px;"><div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach ($category as $category)
                        <li>
                            <a href="{{url('category/product/'.$category->id.'/'.$category->category_slug)}}"> <img src="{{asset($category->category_image)}}" alt="">{{$category->category_name}}</a><span class="count">{{$category->products_count}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div><div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="slider-range" class="mb-20 noUi-target noUi-ltr noUi-horizontal noUi-background"><div class="noUi-base"><div class="noUi-origin noUi-connect" style="left: 25%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin noUi-background" style="left: 50%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">From: <strong id="slider-range-value1" class="text-brand">$500</strong></div>
                                <div class="caption">To: <strong id="slider-range-value2" class="text-brand">$1,000</strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">
                            <label class="fw-900">Color</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                            </div>
                            <label class="fw-900 mt-15">Item Condition</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                <br>
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                            </div>
                        </div>
                    </div>
                    <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                </div><div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    @foreach ($NewProduct as $product)
                    @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount / $product->selling_price)*100;
                    @endphp
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{asset($product->product_thumbnail)}}" alt="#">
                        </div>
                        <div class="content pt-10">
                            <h5><a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{$product->product_name}}</a></h5>
                            <p class="price mb-0 mt-5">@if ($product->discount_price == NULL)
                                ${{$product->selling_price}}
                        @else
                                ${{$product->discount_price}}
                                <span class="old-price">${{$product->selling_price}}</span>
                        @endif</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div><div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none animated" style="visibility: visible;">
                    <img src="{{asset('frontend')}}/assets/imgs/banner/banner-11.png" alt="">
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br>
                            on <span class="text-brand">Oganic</span><br>
                            Juice
                        </h4>
                    </div>
                </div></div></div>
        </div>
    </div>
</main>
@endsection