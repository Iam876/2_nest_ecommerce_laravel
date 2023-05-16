<section class="banners mb-25">
            <div class="container">
                <div class="row">
                        @php
                          $banners = App\Models\Banner\Banner::orderBy('banner_title')->where('banner_status','active')->limit(3)->get();
                        @endphp
                        @foreach ($banners as $banner)
                            <div class="col-lg-4 col-md-6">
                                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                    <img src="{{asset($banner->banner_image)}}" alt="" />
                                    <div class="banner-text">
                                        <h4>{!! nl2br(html_entity_decode($banner->banner_title)) !!}</h4>
                                        <a href="{{$banner->banner_url}}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </section>