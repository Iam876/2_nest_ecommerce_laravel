@extends('frontend.frontendMaster')
@section('title')
Nest | Blog & News Page
@endsection
    <!--End header-->
@section('main-section')
<main class="main">
    <div class="page-header mt-30 mb-75">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Blog &amp; News</h1>
                        <div class="breadcrumb">
                            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Blog &amp; News
                        </div>
                    </div>
                    <div class="col-xl-9 text-end d-none d-xl-block">
                        <ul class="tags-list">
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Shopping</a>
                            </li>
                            <li class="hover-up active">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Recips</a>
                            </li>
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Kitchen</a>
                            </li>
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>News</a>
                            </li>
                            <li class="hover-up mr-0">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Food</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter mb-50 pr-30">
                        <div class="totall-product">
                            <h2>
                                <img class="w-36px mr-10" src="{{asset('frontend')}}/assets/imgs/theme/icons/category-1.svg" alt="">
                                Recips Articles
                            </h2>
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
                                        <span><i class="fi-rs-apps-sort"></i>Sort:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span>Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Newest</a></li>
                                        <li><a href="#">Most comments</a></li>
                                        <li><a href="#">Release Date</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="loop-grid pr-30">
                        <div class="row">
                            @foreach ($blog_post as $blogs)
                            <article class="col-xl-4 col-lg-6 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="{{url('blog/details/'.$blogs->id.'/'.$blogs->post_title_slug)}}">
                                        <img class="border-radius-15" src="{{asset($blogs->post_image)}}" alt="">
                                    </a>
                                    <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="#"><i class="fi-rs-heart"></i></a>
                                    </div>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="#">{{$blogs->BlogCategory->blog_category_name}}</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="{{url('blog/details/'.$blogs->id.'/'.$blogs->post_title_slug)}}">{{$blogs->post_title}}</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            {{-- <span class="post-on mr-10">{{$blogs->created_at}}</span> --}}
                                            <span class="post-on mr-10">{{ \Carbon\Carbon::parse($blogs->created_at)->format('F j, Y') }}
                                            </span>
                                            <span class="hit-count has-dot mr-10">{{$blogs->view_counts}} Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endforeach

                        </div>
                    </div>
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <!-- Previous Page Link -->
                                @if ($blog_post->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous"><i class="fi-rs-arrow-small-left"></i></a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $blog_post->previousPageUrl() }}" aria-label="Previous"><i class="fi-rs-arrow-small-left"></i></a>
                                    </li>
                                @endif
                    
                                <!-- Pagination Links -->
                                @php
                                    $totalPages = $blog_post->lastPage();
                                    $currentPage = $blog_post->currentPage();
                                    $visiblePages = 5; // Number of visible pages (excluding dots)
                                    $numAdjacents = floor(($visiblePages - 1) / 2);
                                    $startPage = max($currentPage - $numAdjacents, 1);
                                    $endPage = min($currentPage + $numAdjacents, $totalPages);
                    
                                    if ($totalPages > $visiblePages) {
                                        if ($startPage == 1) {
                                            $endPage = $visiblePages;
                                        } elseif ($endPage == $totalPages) {
                                            $startPage = $totalPages - $visiblePages + 1;
                                        }
                                    }
                                @endphp
                    
                                @if ($startPage > 1)
                                    <!-- First Page Link -->
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $blog_post->url(1) }}">1</a>
                                    </li>
                    
                                    @if ($startPage > 2)
                                        <!-- Dots before current page range -->
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif
                    
                                @for ($i = $startPage; $i <= $endPage; $i++)
                                    <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $blog_post->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                    
                                @if ($endPage < $totalPages)
                                    @if ($endPage < $totalPages - 1)
                                        <!-- Dots after current page range -->
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                    
                                    <!-- Last Page Link -->
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $blog_post->url($totalPages) }}">{{ $totalPages }}</a>
                                    </li>
                                @endif
                    
                                <!-- Next Page Link -->
                                @if ($blog_post->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $blog_post->nextPageUrl() }}" aria-label="Next"><i class="fi-rs-arrow-small-right"></i></a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Next"><i class="fi-rs-arrow-small-right"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    

                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 1366px;"><div class="widget-area">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search…">
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget widget-category-2 mb-50">
                            <h5 class="section-title style-1 mb-30">Category</h5>
                            <ul>
                                @foreach ($blog_category as $cat)
                                <li>
                                    <a href="#"> <img src="{{asset($cat->blog_category_image)}}" alt="">
                                    {{$cat->blog_category_name}}</a><span class="count">{{$cat->posts_count }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar mb-50 p-30 bg-grey border-radius-10">
                            <h5 class="section-title style-1 mb-30">Trending Now</h5>
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-3.jpg" alt="#">
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                                    <p class="price mb-0 mt-5">$99.50</p>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-4.jpg" alt="#">
                                </div>
                                <div class="content pt-10">
                                    <h6><a href="shop-product-detail.html">Chen Sweater</a></h6>
                                    <p class="price mb-0 mt-5">$89.50</p>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-5.jpg" alt="#">
                                </div>
                                <div class="content pt-10">
                                    <h6><a href="shop-product-detail.html">Colorful Jacket</a></h6>
                                    <p class="price mb-0 mt-5">$25</p>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-6.jpg" alt="#">
                                </div>
                                <div class="content pt-10">
                                    <h6><a href="shop-product-detail.html">Lorem, ipsum</a></h6>
                                    <p class="price mb-0 mt-5">$25</p>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="sidebar-widget widget_instagram mb-50">
                            <h5 class="section-title style-1 mb-30">Gallery</h5>
                            <div class="instagram-gellay">
                                <ul class="insta-feed">
                                    <li>
                                        <a href="#"><img class="border-radius-5" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-1.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img class="border-radius-5" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-2.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img class="border-radius-5" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-3.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img class="border-radius-5" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-4.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img class="border-radius-5" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-5.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img class="border-radius-5" src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-6.jpg" alt=""></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--Tags-->
                        <div class="sidebar-widget widget-tags mb-50 pb-10">
                            <h5 class="section-title style-1 mb-30">Popular Tags</h5>
                            <ul class="tags-list">
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Cabbage</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Broccoli</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Smoothie</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Fruit</a>
                                </li>
                                <li class="hover-up mr-0">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Salad</a>
                                </li>
                                <li class="hover-up mr-0">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Appetizer</a>
                                </li>
                            </ul>
                        </div>
                        <div class="banner-img wow fadeIn mb-50 animated d-lg-block d-none animated" style="visibility: visible;">
                            <img src="{{asset('frontend')}}/assets/imgs/banner/banner-11.png" alt="">
                            <div class="banner-text">
                                <span>Oganic</span>
                                <h4>
                                    Save 17% <br>
                                    on <span class="text-brand">Oganic</span><br>
                                    Juice
                                </h4>
                            </div>
                        </div>
                    </div></div></div>
            </div>
        </div>
    </div>
</main>
@endsection