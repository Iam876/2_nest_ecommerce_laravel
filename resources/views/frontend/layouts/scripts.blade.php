    
    {{-- Stripe Payment --}}
    

    <!-- Vendor JS-->
    <script src="{{asset('frontend')}}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/slick.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/waypoints.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/wow.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/magnific-popup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/select2.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/counterup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/images-loaded.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/isotope.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/scrollup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="{{asset('frontend')}}/assets/js/main.js?v=5.3"></script>
    <script src="{{asset('frontend')}}/assets/js/shop.js?v=5.3"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/slider-range.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- product Modal View With Ajax modalView.js --}}
    <script src="{{asset('frontend')}}/assets/js/modalViewAndCart.js"></script>
    <script src="{{asset('frontend')}}/assets/js/wishList.js"></script>
    <script src="{{asset('frontend')}}/assets/js/compareAjax.js"></script>
    <script src="{{asset('frontend')}}/assets/js/MainCartAjax.js"></script>
    <script src="{{asset('frontend')}}/assets/js/StateAjax.js"></script>
    <script src="{{asset('frontend')}}/assets/js/search.js"></script>
    

	<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
       case 'info':
       toastr.info(" {{ Session::get('message') }} ");
       break;
       case 'success':
       toastr.success(" {{ Session::get('message') }} ");
       break;
       case 'warning':
       toastr.warning(" {{ Session::get('message') }} ");
       break;
       case 'error':
       toastr.error(" {{ Session::get('message') }} ");
       break; 
    }
    @endif
	$(document).ready(function(){
		$(".toast").css("margin-top","60px");
	});
    </script>
