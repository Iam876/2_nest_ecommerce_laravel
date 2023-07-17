@extends('frontend.frontendMaster')
@section('title')
Product Details Page
@endsection
    <!--End header-->
    @section('main-section')
    <main class="main">
            <div class="page-header breadcrumb-wrap">
                <div class="container">
                    <div class="breadcrumb">
                        <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> <a href="#">{{$products->category->category_name}}</a> <span></span> {{$products->subcategory->subcategory_name}}<span></span> {{$products->product_name}}
                    </div>
                </div>
            </div>
            <div class="container mb-30">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50 mt-30">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @foreach ($product_multiimage as $img)
                                            <div><img src="{{asset($img->photo_name)}}" alt="product image" /></div>
                                            @endforeach
                                            
                                             
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails">
                                            @foreach ($product_multiimage as $img)
                                            <div>
                                                <img src="{{asset($img->photo_name)}}" alt="product image" /></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Gallery -->
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info pr-30 pl-30">
                                        @if ($products->product_qty>0)
                                        <span class="stock-status in-stock"> In Stock </span>
                                        @else
                                        <span class="stock-status out-stock"> Stock Out </span>
                                        @endif
                                        <h2 class="title-detail">{{$products->product_name}}</h2>
                                        <div class="product-detail-rating">
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                        @php
                                            $amount = $products->selling_price - $products->discount_price;
                                            $discount = ($amount / $products->selling_price)*100;
                                        @endphp
                                                @if ($products->discount_price == NULL)
                                                    <span class="current-price text-brand">${{$products->selling_price}}</span>
                                                @else
                                                    <span class="current-price text-brand">${{$products->discount_price}}</span>
                                                    <span>
                                                        <span class="save-price font-md color3 ml-15">{{round($discount)}}% Off</span>
                                                        <span class="old-price font-md ml-15">${{$products->selling_price}}</span>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="short-desc mb-30">
                                            <p class="font-lg">{{$products->short_descp}}</p>
                                        </div>
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10">Size / Weight: </strong>
                                            @if ($products->product_size == NULL)
                                                <span class="text-warning">No size is available</span>
                                            @else
                                            <ul class="list-filter size-filter font-small" id="ProductSize">
                                                @foreach ($product_size as $size)
                                                @php
                                                    $isActive = "Small";
                                                @endphp
                                                    <li class="{{ $isActive == $size ? 'active' : '' }}">
                                                        <a href="#" data-value="{{ $size }}">{{ $size }}</a>
                                                    </li>
                                                @endforeach
                                            </ul> 
                                            @endif
                                        </div>
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10">Color : </strong>
                                            @if ($products->product_color == NULL)
                                                <span class="text-warning">No color is available</span>
                                            @else
                                            <ul class="list-filter size-filter font-small" id="ProductColor">
                                                @foreach ($product_color as $color)
                                                @php
                                                    $isActive = "Red";
                                                @endphp
                                                    <li class="{{ $isActive == $color ? 'active' : '' }}">
                                                        <a href="#" data-value="{{ $color }}">{{ $color }}</a>
                                                    </li>
                                                @endforeach
                                            </ul> 
                                            @endif
                                        </div>
                                        <div class="detail-extralink mb-50">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <input type="text" name="quantity" class="qty-val" value="1" min="1" id="ProductQty">
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                            <div class="product-extra-link2">
                                                @php
                                                    $id = request()->route('id');
                                                @endphp
                                                {{-- <input type="hidden" id="product_id"> --}}
                                                <button type="submit" class="button button-add-to-cart" id="DetailAddToCart"><i class="fi-rs-shopping-cart" data-value="{{$id}}"></i>Add to cart</button>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                        </div>
    <div class="font-xs">
        <ul class="mr-50 float-start">
            <li class="mb-5">Brand: <span class="text-brand">{{$products->brand->brand_name}}</span></li>
            <li class="mb-5">MFG:<span class="text-brand"> {{$products->created_at}}</span></li>
            <li class="mb-5">Tags: 
                @foreach ($product_tags as $tags)
                <a href="#" rel="tag" value="{{$tags}}">{{$tags}}</a>
                @endforeach
            </li>
            <li class="mb-5">vendor: <span class="text-brand" id="productDetailsVendorId" data-value="{{$products->vendor->id}}">{{$products->vendor->name}}</span></li>

        </ul>
        <ul class="float-start">
            <li class="mb-5">SKU: <a href="#">{{$products->product_code}}</a></li>
            @if ($products->product_qty == NULL)
            <li>Stock:<span class="out-stock text-brand ml-5">Stock Out</span></li>
            @else
            <li>Stock:<span class="in-stock text-brand ml-5">{{$products->product_qty}} Items In Stock</span></li>
            @endif
            <li class="mb-5">Category: <span class="text-brand">{{$products->category->category_name}}</span></li>
            <li class="mb-5">Subcategory: <span class="text-brand">{{$products->subcategory->subcategory_name}}</span></li>
            
        </ul>
    </div>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Description">
                                            <div class="">{!! $products->long_descp !!}</div>
                                        </div>
                                        <div class="tab-pane fade" id="Additional-info">
                                            <table class="font-md">
                                                <tbody>
                                                    <tr class="stand-up">
                                                        <th>Stand Up</th>
                                                        <td>
                                                            <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="folded-wo-wheels">
                                                        <th>Folded (w/o wheels)</th>
                                                        <td>
                                                            <p>32.5″L x 18.5″W x 16.5″H</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="folded-w-wheels">
                                                        <th>Folded (w/ wheels)</th>
                                                        <td>
                                                            <p>32.5″L x 24″W x 18.5″H</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="door-pass-through">
                                                        <th>Door Pass Through</th>
                                                        <td>
                                                            <p>24</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="frame">
                                                        <th>Frame</th>
                                                        <td>
                                                            <p>Aluminum</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="weight-wo-wheels">
                                                        <th>Weight (w/o wheels)</th>
                                                        <td>
                                                            <p>20 LBS</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="weight-capacity">
                                                        <th>Weight Capacity</th>
                                                        <td>
                                                            <p>60 LBS</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="width">
                                                        <th>Width</th>
                                                        <td>
                                                            <p>24″</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="handle-height-ground-to-handle">
                                                        <th>Handle height (ground to handle)</th>
                                                        <td>
                                                            <p>37-45″</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="wheels">
                                                        <th>Wheels</th>
                                                        <td>
                                                            <p>12″ air / wide track slick tread</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="seat-back-height">
                                                        <th>Seat back height</th>
                                                        <td>
                                                            <p>21.5″</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="head-room-inside-canopy">
                                                        <th>Head room (inside canopy)</th>
                                                        <td>
                                                            <p>25″</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="pa_color">
                                                        <th>Color</th>
                                                        <td>
                                                            <p>Black, Blue, Red, White</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="pa_size">
                                                        <th>Size</th>
                                                        <td>
                                                            <p>M, S</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="Vendor-info">
                                            <div class="vendor-logo d-flex mb-30">
                                                <img src="/upload/vendor-images/{{$products->vendor->photo}}" alt="" />
                                                <div class="vendor-name ml-15">
                                                    <h6>
                                                        <a href="">{{$products->vendor->name}}.</a>
                                                    </h6>
                                                    <div class="product-rate-cover text-end">
                                                        <div class="product-rate d-inline-block">
                                                            <div class="product-rating" style="width: 90%"></div>
                                                        </div>
                                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="contact-infor mb-50">
                                                <li><img src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{$products->vendor->address}}</span></li>
                                                <li><img src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>{{$products->vendor->phone}}</span></li>
                                            </ul>
                                            <div class="d-flex mb-55">
                                                <div class="mr-30">
                                                    <p class="text-brand font-xs">Rating</p>
                                                    <h4 class="mb-0">92%</h4>
                                                </div>
                                                <div class="mr-30">
                                                    <p class="text-brand font-xs">Ship on time</p>
                                                    <h4 class="mb-0">100%</h4>
                                                </div>
                                                <div>
                                                    <p class="text-brand font-xs">Chat response</p>
                                                    <h4 class="mb-0">89%</h4>
                                                </div>
                                            </div>
                                            <p>{{$products->vendor->short_desc}}</p>
                                        </div>
                                        <div class="tab-pane fade" id="Reviews">
                                            <!--Comments-->
                                            <div class="comments-area">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h4 class="mb-30">Customer questions & answers</h4>
                                                        <div id="commentContainer" class="comment-list">
                                                            @foreach ($reviews as $review)
                                                            <div class="single-comment justify-content-between d-flex mb-30">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <?php 
                                                                                $imagePaths = [
                                                                                '/upload/admin-images/',
                                                                                '/upload/user-images/',
                                                                                '/upload/vendor-images/',
                                                                            ];
                                                                            $imageUrl = null;
                                                                            foreach ($imagePaths as $imagePath) {
                                                                                $imageFullPath = public_path($imagePath . $review->user->photo);
                                                                                if (file_exists($imageFullPath)) {
                                                                                    $imageUrl = asset($imagePath . $review->user->photo);
                                                                                    break;
                                                                                }
                                                                            }    
                                                                            ?>
                                                                        <img src="{{asset($imageUrl)}}" alt="" />
                                                                        <span class="font-heading text-brand">
                                                                            {{$review->user->username}}
                                                                        </span>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div class="d-flex justify-content-between mb-10">
                                                                            <div class="d-flex align-items-center">
                                                                                <span class="font-xs text-muted"> {{$review->created_at}} </span>
                                                                            </div>
                                                                            <div class="product-rate d-inline-block">
                                                                                @if ($review->rating == 1 && $review->rating!==5)
                                                                                <div class="product-rating" style="width: 20%"></div>
                                                                                @elseif($review->rating == 2 && $review->rating!==5)
                                                                                <div class="product-rating" style="width: 40%"></div>
                                                                                @elseif($review->rating == 3 && $review->rating!==5)
                                                                                <div class="product-rating" style="width: 60%"></div>
                                                                                @elseif($review->rating == 4 && $review->rating!==5)
                                                                                <div class="product-rating" style="width: 80%"></div>
                                                                                @elseif($review->rating == 5 && $review->rating<6)
                                                                                <div class="product-rating" style="width: 100%"></div>
                                                                                    
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">{{$review->comment}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            {{-- <button id="loadMoreBtn" class="btn btn-success">Load More</button> --}}
                                                            {{-- <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="{{asset('frontend')}}/assets/imgs/blog/author-3.png" alt="" />
                                                                        <a href="#" class="font-heading text-brand">Brenna</a>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div class="d-flex justify-content-between mb-10">
                                                                            <div class="d-flex align-items-center">
                                                                                <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                            </div>
                                                                            <div class="product-rate d-inline-block">
                                                                                <div class="product-rating" style="width: 80%"></div>
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h4 class="mb-30">Customer reviews</h4>
                                                        <div class="d-flex mb-30">
                                                            <div class="product-rate d-inline-block mr-15">
                                                                @if ($averageRating == 1 && $averageRating!==5)
                                                                <div class="product-rating" style="width: 20%"></div>
                                                                @elseif($averageRating == 2 && $averageRating!==5)
                                                                <div class="product-rating" style="width: 40%"></div>
                                                                @elseif($averageRating == 3 && $averageRating!==5)
                                                                <div class="product-rating" style="width: 60%"></div>
                                                                @elseif($averageRating == 4 && $averageRating!==5)
                                                                <div class="product-rating" style="width: 80%"></div>
                                                                @elseif($averageRating == 5 && $averageRating<6)
                                                                <div class="product-rating" style="width: 100%"></div>
                                                                @endif
                                                            </div>
                                                            @if ($averageRating<5)
                                                            <h6>{{$averageRating}} Out of 5</h6>
                                                            @else
                                                            <h6>{{$averageRating}}</h6>
                                                            @endif
                                                        </div>
                                                        <div class="progress">
                                                            <span>5 star</span>
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $ratingsPercentage->get(5, 0) }}%" aria-valuenow="{{ $ratingsPercentage->get(5, 0) }}" aria-valuemin="0" aria-valuemax="100">{{ $ratingsPercentage->get(5, 0) }}%</div>
                                                        </div>
                                                        <div class="progress">
                                                            <span>4 star</span>
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $ratingsPercentage->get(4, 0) }}%" aria-valuenow="{{ $ratingsPercentage->get(4, 0) }}" aria-valuemin="0" aria-valuemax="100">{{ $ratingsPercentage->get(4, 0) }}%</div>
                                                        </div>
                                                        <div class="progress">
                                                            <span>3 star</span>
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $ratingsPercentage->get(3, 0) }}%" aria-valuenow="{{ $ratingsPercentage->get(3, 0) }}" aria-valuemin="0" aria-valuemax="100">{{ $ratingsPercentage->get(3, 0) }}%</div>
                                                        </div>
                                                        <div class="progress">
                                                            <span>2 star</span>
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $ratingsPercentage->get(2, 0) }}%" aria-valuenow="{{ $ratingsPercentage->get(2, 0) }}" aria-valuemin="0" aria-valuemax="100">{{ $ratingsPercentage->get(2, 0) }}%</div>
                                                        </div>
                                                        <div class="progress mb-30">
                                                            <span>1 star</span>
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $ratingsPercentage->get(1, 0) }}%" aria-valuenow="{{ $ratingsPercentage->get(1, 0) }}" aria-valuemin="0" aria-valuemax="100">{{ $ratingsPercentage->get(1, 0) }}%</div>
                                                        </div>
                                                        
                                                        <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--comment form-->
                                            <div class="comment-form">
                                                <h4 class="mb-15">Add a review</h4>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        @guest
                                                            <p>To add review,Please login first <a href="{{Route('login')}}">Login here</a></p>
                                                        @else
                                                        <form class="form-contact comment_form" action="{{Route('store.product.review',['Rvendor' => $products->vendor->id, 'Rproduct' => $products->id])}}" method="POST" id="commentForm">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="rate w-25">
                                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                                    <label for="star5" class="star" title="text">5 stars</label>
                                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                                    <label for="star4" class="star" title="text">4 stars</label>
                                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                                    <label for="star3" class="star" title="text">3 stars</label>
                                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                                    <label for="star2" class="star" title="text">2 stars</label>
                                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                                    <label for="star1" class="star" title="text">1 star</label>
                                                                  </div>
                                                                  
                                                                  <div class="col-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                        <div class="d-flex justify-content-between">
                                                                            <span id="alertMaxInput" class="text-danger"></span>
                                                                            <span id="charctercount">0 / 255 characters</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="button button-contactForm">Submit Review</button>
                                                            </div>
                                                        </form>
                                                        @endguest
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h2 class="section-title style-1 mb-30">Related products</h2>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                    @php
                                        $amount = $products->selling_price - $products->discount_price;
                                        $discount = round(($amount / $products->selling_price)*100);
                                    @endphp
                                        @foreach ($related_products as $products)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="shop-product-right.html" tabindex="0">
                                                            <img class="default-img" src="{{asset($products->product_thumbnail)}}" alt="" />
                                                            <img class="hover-img" src="{{asset($products->product_thumbnail)}}" alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        @if($products->discount_price == NULL)
                                                        <span class="new">New</span>
                                                        @else
                                                        <span class="hot">{{$discount}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="{{url('product/details/'.$products->id.'/'.$products->product_slug)}}" tabindex="0">{{$products->product_name}}</a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span> </span>
                                                    </div>
                                                    <div class="product-price">
                                                        @if($products->discount_price == NULL)
                                                        <span>${{$products->selling_price}} </span>
                                                        @else
                                                        <span>${{$products->discount_price}} </span>
                                                        <span class="old-price">${{$products->selling_price}}</span>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
$(document).ready(function() {
    var maxLength = 255; // Maximum character count
    var textarea = $('#comment');
    var alertMaxInput = $('#alertMaxInput');
    var characterCount = $('#charctercount');

    textarea.keyup(function() {
        var length = $(this).val().length;
        var remaining = maxLength - length;

        characterCount.text(length + ' / ' + maxLength + ' characters');

        if (remaining < 0) {
            $(this).val($(this).val().substring(0, maxLength));
            $(this).removeClass('form-control').addClass('border-danger');
            alertMaxInput.text('Max input exceeded');
        } else {
            $(this).addClass('form-control').removeClass('border-danger');
            alertMaxInput.text('');
        }
    });
});

// $(document).ready(function() {
//   var limit = 5;
//   $("#commentContainer .single-comment").slice(0, limit).show();

//   $(document).on('click', '#loadMoreBtn', function(e) {
//     limit += 5;
//     e.preventDefault();
//     $("#commentContainer .single-comment").slice(0, limit).show();
//   });
// });


const labels = document.querySelectorAll('.star');
labels.forEach(label => {
  label.addEventListener('click', (event) => {
    event.preventDefault();
    const inputId = label.getAttribute('for');
    const input = document.getElementById(inputId);
    if (input) {
      input.checked = true; // Select the corresponding radio button
    }
  });
});
    </script>
    @endsection
