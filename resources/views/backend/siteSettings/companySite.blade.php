@extends('admin.adminMasterDashboard')
@section('title')
    Admin | All Product
@endsection
    
    @section('main-content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Product</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Product Data</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Product</h6>
				<hr/>
				<div class="card col-md-6">
					<div class="card-body">
                        <div class="p-4 border rounded">
                            <form class="row" method="POST" action="{{route('company.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="Textarea" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" id="Textarea" placeholder="Max length 180 Character" required>{{$CompanySettings->short_desc}}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="Support" class="form-label">Support Phone</label>
                                    <input type="text" id="Support" name="supportContact" class="form-control" placeholder="Enter Support Number" value="{{$CompanySettings->support_phone}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Contact2" class="form-label">Phone Number</label>
                                    <input type="text" id="Contact2" name="Contact_second" class="form-control" placeholder="Enter Secondary Contact Number" value="{{$CompanySettings->phone_one}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="OpenHours" class="form-label">Open Hours</label>
                                    <input type="text" id="OpenHours" name="OpenHours" class="form-control" placeholder="Enter Open Hours" value="{{$CompanySettings->open_hours}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="OpenDays" class="form-label">Open Days</label>
                                    <input type="text" id="OpenDays" name="OpenDays" class="form-control" placeholder="Enter Open Days" value="{{$CompanySettings->active_days}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{$CompanySettings->email}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Company Address</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address" value="{{$CompanySettings->company_address}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Facebook" class="form-label">Facebook URL</label>
                                    <input type="text" id="Facebook" name="Facebook" class="form-control" placeholder="Enter Facebook Full URL" value="{{$CompanySettings->facebook}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Twitter" class="form-label">Twitter URL</label>
                                    <input type="text" id="Twitter" name="Twitter" class="form-control" placeholder="Enter Twitter Full URL" value="{{$CompanySettings->twitter}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Youtube" class="form-label">Youtube URL</label>
                                    <input type="text" id="Youtube" name="Youtube" class="form-control" placeholder="Enter Youtube Full URL" value="{{$CompanySettings->youtube}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Instagram" class="form-label">Instagram URL</label>
                                    <input type="text" id="Instagram" name="Instagram" class="form-control" placeholder="Enter Instagram Full URL" value="{{$CompanySettings->instagram}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Pinterest" class="form-label">Pinterest URL</label>
                                    <input type="text" id="Pinterest" name="Pinterest" class="form-control" placeholder="Enter Pinterest Full URL" value="{{$CompanySettings->pinterest}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Copyright" class="form-label">Copyright</label>
                                    <input type="text" id="Copyright" name="Copyright" class="form-control" placeholder="Enter Copyright Text" value="{{$CompanySettings->copyright}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="offerMessage" class="form-label">Offer Message</label>
                                    <input type="text" id="offerMessage" name="offerMessage" class="form-control" placeholder="Enter Offer Message" value="{{$CompanySettings->message}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="LogoUpload" class="form-label">Logo Upload</label>
                                    <input type="file" class="form-control" id="LogoUpload" name="LogoUpload">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Photo</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <img src="{{asset($CompanySettings->logo)}}" id="showImageCat" alt="Admin" width="110">
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Save Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>			 
			</div>
    </main>

    <script type="text/javaScript">
		$(document).ready(function(e) {

			$(document).on("click","#LogoUpload",function(){
					$('#LogoUpload').change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#showImageCat').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});
			// $(document).on("click","#category_image_logo",function(){
			// 		$('#category_image_logo').change(function(e){
			// 		var reader = new FileReader();
			// 		reader.onload=function(e) {
			// 			$('#showImageCatLogo').attr('src',e.target.result);
			// 		}
			// 		reader.readAsDataURL(e.target.files['0']);
			// 	});
			// });		
		});
        </script>
    @endsection