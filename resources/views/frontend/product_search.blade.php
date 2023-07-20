@extends('frontend.frontendMaster')
@section('title')
Product Search
@endsection
    <!--End header-->
    @section('main-section')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
           <div class="container">
              <div class="breadcrumb">
                 <div class="breadcrumb-item d-inline-block"><a href="{{url('/')}}" title="Home"> Home </a></div>
                 <span></span>
                 <div class="breadcrumb-item d-inline-block active">
                    <div itemprop="item"> Search </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="container mb-30">
           <div class="row">
              <div class="col-lg-12 m-auto">
                 {{-- <div class="col-lg-12 m-auto my-5">
                    <a class="shop-filter-toggle" href="#"><span class="fi-rs-filter mr-5"></span><span class="title">Filters</span><i class="fi-rs-angle-small-up angle-up"></i><i class="fi-rs-angle-small-down angle-down"></i></a>
                    <form action="#/products" method="GET" id="products-filter-ajax" data-gtm-form-interact-id="0">
                       <div class="shop-product-filter-header mb-3 page_speed_493391520" style="display: none;">
                          <div class="row">
                             <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                                <h5 class="mb-20 widget__title" data-title="Category">By categories</h5>
                                <div class="custome-checkbox ps-custom-scrollbar mCustomScrollbar _mCS_1 mCS_no_scrollbar">
                                   <div id="mCSB_1" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                                      <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr"><span></span><input class="form-check-input category-filter-input" data-id="1" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-1" value="1" data-gtm-form-interact-field-id="0"><label class="form-check-label" for="category-filter-1"><span class="d-inline-block">Milks and Dairies</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="2" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-2" value="2"><label class="form-check-label" for="category-filter-2"><span class="d-inline-block">Clothing &amp; beauty</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="3" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-3" value="3"><label class="form-check-label" for="category-filter-3"><span class="d-inline-block">Pet Toy</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="4" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-4" value="4"><label class="form-check-label" for="category-filter-4"><span class="d-inline-block">Baking material</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="5" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-5" value="5"><label class="form-check-label" for="category-filter-5"><span class="d-inline-block">Fresh Fruit</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="6" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-6" value="6"><label class="form-check-label" for="category-filter-6"><span class="d-inline-block">Wines &amp; Drinks</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="7" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-7" value="7"><label class="form-check-label" for="category-filter-7"><span class="d-inline-block">Fresh Seafood</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="8" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-8" value="8"><label class="form-check-label" for="category-filter-8"><span class="d-inline-block">Fast food</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="9" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-9" value="9"><label class="form-check-label" for="category-filter-9"><span class="d-inline-block">Vegetables</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="10" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-10" value="10"><label class="form-check-label" for="category-filter-10"><span class="d-inline-block">Bread and Juice</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="11" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-11" value="11"><label class="form-check-label" for="category-filter-11"><span class="d-inline-block">Cake &amp; Milk</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="12" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-12" value="12"><label class="form-check-label" for="category-filter-12"><span class="d-inline-block">Coffee &amp; Teas</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="13" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-13" value="13"><label class="form-check-label" for="category-filter-13"><span class="d-inline-block">Pet Foods</span></label><br><span></span><input class="form-check-input category-filter-input" data-id="14" data-parent-id="" name="categories[]" type="checkbox" id="category-filter-14" value="14"><label class="form-check-label" for="category-filter-14"><span class="d-inline-block">Diet Foods</span></label><br></div>
                                      <div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: none;">
                                         <div class="mCSB_draggerContainer">
                                            <div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; display: block; height: 213px; max-height: 290px;">
                                               <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                            </div>
                                            <div class="mCSB_draggerRail"></div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                                <h5 class="mb-20 widget__title" data-title="Brand">By Brands</h5>
                                <div class="custome-checkbox ps-custom-scrollbar mCustomScrollbar _mCS_2 mCS_no_scrollbar">
                                   <div id="mCSB_2" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                                      <div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr"><input class="form-check-input" name="brands[]" type="checkbox" id="brand-filter-1" value="1"><label class="form-check-label" for="brand-filter-1"><span class="d-inline-block">Perxsion</span><span class="d-inline-block">(3)</span></label><br><input class="form-check-input" name="brands[]" type="checkbox" id="brand-filter-2" value="2"><label class="form-check-label" for="brand-filter-2"><span class="d-inline-block">Hiching</span><span class="d-inline-block">(2)</span></label><br><input class="form-check-input" name="brands[]" type="checkbox" id="brand-filter-3" value="3"><label class="form-check-label" for="brand-filter-3"><span class="d-inline-block">Kepslo</span><span class="d-inline-block">(7)</span></label><br><input class="form-check-input" name="brands[]" type="checkbox" id="brand-filter-4" value="4"><label class="form-check-label" for="brand-filter-4"><span class="d-inline-block">Groneba</span><span class="d-inline-block">(1)</span></label><br><input class="form-check-input" name="brands[]" type="checkbox" id="brand-filter-5" value="5"><label class="form-check-label" for="brand-filter-5"><span class="d-inline-block">Babian</span><span class="d-inline-block">(2)</span></label><br><input class="form-check-input" name="brands[]" type="checkbox" id="brand-filter-6" value="6"><label class="form-check-label" for="brand-filter-6"><span class="d-inline-block">Valorant</span><span class="d-inline-block">(4)</span></label><br><input class="form-check-input" name="brands[]" type="checkbox" id="brand-filter-7" value="7"><label class="form-check-label" for="brand-filter-7"><span class="d-inline-block">Pure</span><span class="d-inline-block">(5)</span></label><br></div>
                                      <div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: none;">
                                         <div class="mCSB_draggerContainer">
                                            <div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; display: block; height: 211px; max-height: 200.851px;">
                                               <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                            </div>
                                            <div class="mCSB_draggerRail"></div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                                <h5 class="mb-20 widget__title" data-title="Tag">By tags</h5>
                                <div class="custome-checkbox ps-custom-scrollbar mCustomScrollbar _mCS_3 mCS_no_scrollbar">
                                   <div id="mCSB_3" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                                      <div id="mCSB_3_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr"><input class="form-check-input" name="tags[]" type="checkbox" id="tag-filter-2" value="2"><label class="form-check-label" for="tag-filter-2"><span class="d-inline-block">Bags</span><span class="d-inline-block">(13)</span></label><br><input class="form-check-input" name="tags[]" type="checkbox" id="tag-filter-5" value="5"><label class="form-check-label" for="tag-filter-5"><span class="d-inline-block">Hand bag</span><span class="d-inline-block">(11)</span></label><br><input class="form-check-input" name="tags[]" type="checkbox" id="tag-filter-3" value="3"><label class="form-check-label" for="tag-filter-3"><span class="d-inline-block">Shoes</span><span class="d-inline-block">(10)</span></label><br><input class="form-check-input" name="tags[]" type="checkbox" id="tag-filter-1" value="1"><label class="form-check-label" for="tag-filter-1"><span class="d-inline-block">Wallet</span><span class="d-inline-block">(8)</span></label><br><input class="form-check-input" name="tags[]" type="checkbox" id="tag-filter-4" value="4"><label class="form-check-label" for="tag-filter-4"><span class="d-inline-block">Clothes</span><span class="d-inline-block">(7)</span></label><br></div>
                                      <div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: none;">
                                         <div class="mCSB_draggerContainer">
                                            <div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; display: block; height: 151px; max-height: 140.608px;">
                                               <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                            </div>
                                            <div class="mCSB_draggerRail"></div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" data-type="price">
                                <h5 class="mb-20 widget__title" data-title="Price">By Price</h5>
                                <div class="price-filter range">
                                   <div class="price-filter-inner">
                                      <div class="slider-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                         <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
                                         <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span>
                                      </div>
                                      <input type="hidden" class="min_price min-range" name="min_price" value="0" data-min="0" data-label="Min price"><input type="hidden" class="min_price max-range" name="max_price" value="284" data-max="284" data-label="Max price">
                                      <div class="price_slider_amount">
                                         <div class="label-input"><span class="d-inline-block">Range: </span><span class="from d-inline-block">$0.00</span><span class="to d-inline-block">$284.00</span></div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <a class="show-advanced-filters" href="#"><span class="title">Advanced filters</span><i class="fi-rs-angle-up angle-down"></i><i class="fi-rs-angle-down angle-up"></i></a>
                          <div class="advanced-search-widgets page_speed_493391520">
                             <div class="row">
                                <div class="col-xl-3 col-lg-6 col-md-6 mb-lg-0 mb-md-2 mb-sm-2 widget-filter-item" data-type="text">
                                   <div class="card">
                                      <h5 class="mb-30 widget__title" data-title="Weight">By Weight</h5>
                                      <div class="sidebar-widget">
                                         <div class="list-filter size-filter ps-custom-scrollbar mCustomScrollbar _mCS_4 mCS_no_scrollbar">
                                            <div id="mCSB_4" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                                               <div id="mCSB_4_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                                  <li data-slug="1kg">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="1"><span><i class="fi-rs- mr-10"></i> 1KG</span></label></div>
                                                  </li>
                                                  <li data-slug="2kg">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="2"><span><i class="fi-rs- mr-10"></i> 2KG</span></label></div>
                                                  </li>
                                                  <li data-slug="3kg">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="3"><span><i class="fi-rs- mr-10"></i> 3KG</span></label></div>
                                                  </li>
                                                  <li data-slug="4kg">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="4"><span><i class="fi-rs- mr-10"></i> 4KG</span></label></div>
                                                  </li>
                                                  <li data-slug="5kg">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="5"><span><i class="fi-rs- mr-10"></i> 5KG</span></label></div>
                                                  </li>
                                               </div>
                                               <div id="mCSB_4_scrollbar_vertical" class="mCSB_scrollTools mCSB_4_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: none;">
                                                  <div class="mCSB_draggerContainer">
                                                     <div id="mCSB_4_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;">
                                                        <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                                     </div>
                                                     <div class="mCSB_draggerRail"></div>
                                                  </div>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 mb-lg-0 mb-md-2 mb-sm-2 widget-filter-item" data-type="text">
                                   <div class="card">
                                      <h5 class="mb-30 widget__title" data-title="Boxes">By Boxes</h5>
                                      <div class="sidebar-widget">
                                         <div class="list-filter size-filter ps-custom-scrollbar mCustomScrollbar _mCS_5 mCS_no_scrollbar">
                                            <div id="mCSB_5" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                                               <div id="mCSB_5_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                                  <li data-slug="1box">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="6"><span><i class="fi-rs- mr-10"></i> 1 Box</span></label></div>
                                                  </li>
                                                  <li data-slug="2boxes">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="7"><span><i class="fi-rs- mr-10"></i> 2 Boxes</span></label></div>
                                                  </li>
                                                  <li data-slug="3boxes">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="8"><span><i class="fi-rs- mr-10"></i> 3 Boxes</span></label></div>
                                                  </li>
                                                  <li data-slug="4boxes">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="9"><span><i class="fi-rs- mr-10"></i> 4 Boxes</span></label></div>
                                                  </li>
                                                  <li data-slug="5boxes">
                                                     <div class="tags-checkbox"><label><input class="product-filter-item" type="checkbox" name="attributes[]" value="10"><span><i class="fi-rs- mr-10"></i> 5 Boxes</span></label></div>
                                                  </li>
                                               </div>
                                               <div id="mCSB_5_scrollbar_vertical" class="mCSB_scrollTools mCSB_5_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: none;">
                                                  <div class="mCSB_draggerContainer">
                                                     <div id="mCSB_5_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;">
                                                        <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                                     </div>
                                                     <div class="mCSB_draggerRail"></div>
                                                  </div>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="widget"><button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5 ml-0"></i> Filter</button><a class="clear_filter dib clear_all_filter mx-4 btn btn-danger btn-sm" href="#/products"><i class="fi-rs-refresh mr-5 ml-0"></i> Clear All Filters</a></div>
                       </div>
                    </form>
                 </div> --}}
                 <div class="products-listing position-relative">
                    <div class="list-content-loading">
                       <div class="half-circle-spinner">
                          <div class="circle circle-1"></div>
                          <div class="circle circle-2"></div>
                       </div>
                    </div>
                    <div class="shop-product-filter">
                       <div class="total-product mt-5 mb-5">
                          <p>We found <strong class="text-brand">{{count($products)}}</strong> items for you!</p>
                       </div>
                       {{-- <div class="sort-by-product-area">
                          <div class="sort-by-cover mr-10 products_sortby">
                             <div class="sort-by-product-wrap">
                                <div class="sort-by"><span><i class="fi-rs-apps"></i>Show:</span></div>
                                <div class="sort-by-dropdown-wrap"><span> 12 <i class="fi-rs-angle-small-down"></i></span></div>
                             </div>
                             <div class="sort-by-dropdown products_ajaxsortby" data-name="num">
                                <ul>
                                   <li><a data-label="12" class=" active " href="#/products?q=n&amp;num=12">12</a></li>
                                   <li><a data-label="24" class="" href="#/products?q=n&amp;num=24">24</a></li>
                                   <li><a data-label="36" class="" href="#/products?q=n&amp;num=36">36</a></li>
                                </ul>
                             </div>
                          </div>
                          <div class="sort-by-cover products_sortby">
                             <div class="sort-by-product-wrap">
                                <div class="sort-by"><span><i class="fi-rs-apps-sort"></i>Sort by:</span></div>
                                <div class="sort-by-dropdown-wrap"><span><span></span><i class="fi-rs-angle-small-down"></i></span></div>
                             </div>
                             <div class="sort-by-dropdown products_ajaxsortby" data-name="sort-by">
                                <ul>
                                   <li><a data-label="Default" class="" href="#/products?q=n&amp;sort-by=default_sorting">Default</a></li>
                                   <li><a data-label="Oldest" class="" href="#/products?q=n&amp;sort-by=date_asc">Oldest</a></li>
                                   <li><a data-label="Newest" class="" href="#/products?q=n&amp;sort-by=date_desc">Newest</a></li>
                                   <li><a data-label="Price: low to high" class="" href="#/products?q=n&amp;sort-by=price_asc">Price: low to high</a></li>
                                   <li><a data-label="Price: high to low" class="" href="#/products?q=n&amp;sort-by=price_desc">Price: high to low</a></li>
                                   <li><a data-label="Name: A-Z" class="" href="#/products?q=n&amp;sort-by=name_asc">Name: A-Z</a></li>
                                   <li><a data-label="Name : Z-A" class="" href="#/products?q=n&amp;sort-by=name_desc">Name : Z-A</a></li>
                                   <li><a data-label="Rating: low to high" class="" href="#/products?q=n&amp;sort-by=rating_asc">Rating: low to high</a></li>
                                   <li><a data-label="Rating: high to low" class="" href="#/products?q=n&amp;sort-by=rating_desc">Rating: high to low</a></li>
                                </ul>
                             </div>
                          </div>
                       </div> --}}
                    </div>
                    {{-- <input type="hidden" name="page" data-value="1"><input type="hidden" name="sort-by" value="null"><input type="hidden" name="num" value="0"><input type="hidden" name="q" value="n"> --}}
                    <div class="row product-grid">
                        @foreach ($products as $product)

                            @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount / $product->selling_price)*100;
                            @endphp
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                            <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                            <img class="hover-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="ProductWishListIcon" data-id="{{$product->id}}"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" id="CompareProductIcon" data-id="{{$product->id}}"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="ProductModalShow" data-id="{{$product->id}}"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($product->discount_price == NULL)
                                                        <span class="hot">Hot</span>
                                                    @else
                                                        <span class="hot">{{round($discount)}} %</span>
                                                    @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{$product->category->category_name}}</a>
                                    </div>
                                    <h2><a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{$product->product_name}}</a></h2>                                        <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">
                                        @if ($product->vendor->name == NULL)
                                        <a href="vendor-details-1.html">Owner</a></span>
                                        @else
                                        <a href="vendor-details-1.html">{{$product->vendor->name}}</a></span>
                                        @endif    
                                        </a></span>
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
                                            <a class="add" id="AddMainCart" data-value="{{$product->id}}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="pagination-area mt-20 mb-20 pagination-page">
                       {{-- <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-start">
                             <li class="page-item active"><span class="page-link">1</span></li>
                             <li class="page-item"><a class="page-link" href="#/products?q=n&amp;page=2">2</a></li>
                             <li class="page-item"><a class="next page-link" href="#/products?q=n&amp;page=2" rel="next"><i class="fi-rs-arrow-small-right"></i></a></li>
                          </ul>
                       </nav> --}}
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </main>
@endsection