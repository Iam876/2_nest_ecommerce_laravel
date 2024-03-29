<footer class="page-footer">
			<p class="mb-0">Copyright © 2021. All right reserved.</p>
</footer>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{asset('adminBackend')}}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{asset('adminBackend')}}/assets/js/jquery.min.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{asset('adminBackend')}}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/jquery-knob/jquery.knob.js"></script>
	<script src="{{asset('adminBackend')}}/assets/plugins/input-tags/js/tagsinput.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/4j2n91w9r6y1yn45hy2mqe2lx5ocgo8iwdn6j4efn5h6j6ko/tinymce/5/tinymce.min.js" referrerpolicy="origin">
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src="{{asset('adminBackend')}}/assets/js/index.js"></script>
	<!--app JS-->
	<script src="{{asset('adminBackend')}}/assets/js/app.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
</body>

</html>