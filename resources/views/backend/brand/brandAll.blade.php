@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Data Table</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" data-bs-toggle="modal" data-bs-target="#addDataModal" class="btn btn-primary">Add Brand</button>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">DataTable Example</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Brand Name</th>
										<th>Brand Image</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="tbody">
 
                                   
								</tbody>
								<tfoot>
									<tr>
										<th>Sl</th>
										<th>Brand Name</th>
										<th>Brand Image</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

				<!-- Modal To Add Data -->
				<div class="modal" tabindex="-1" id="addDataModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Add Brand</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Brand Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="brand_name" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Brand Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="brand_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImage" alt="Admin" width="110">
								</div>
							</div>
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="add_brand">Add Brand</button>
							</div>
						
					  </div>
					</div>
				  </div>

				  <!-- To Update Data -->
				<div class="modal" tabindex="-1" id="updateModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Add Brand</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Brand Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_brand_name" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Brand Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="edit_brand_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3" id="new_photo" hidden>
								<div class="col-sm-3">
									<h6 class="mb-0">New Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImageData" alt="Admin" width="110">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Old Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImageV" alt="Admin" width="110">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_brand_status" aria-label="Default select example">
										<option selected>Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
							
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="update_brand">Update</button>
							</div>
						
					  </div>
					</div>
				  </div>

				  <!-- To Delete Data -->
				<div class="modal" tabindex="-1" id="OpenDelete">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Delete Data | This is not revertable</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3">
								<h6 class="mb-0">Are you sure to delete ?</h6>
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-danger px-4 " id="delete_data">Delete</button>
							</div>
						
					  </div>
					</div>
				  </div>
				 
			</div>
    </main>

	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{asset('adminBackend')}}/assets/js/AdminBrandAjax.js"></script>

	<script type="text/javaScript">
		$(document).ready(function(e) {

			$(document).on("click","#brand_image",function(){
					$('#brand_image').change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#showImage').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});
			$(document).on("click","#edit_brand_image",function(e){
				$("#new_photo").removeAttr("hidden");
				$("#edit_brand_image").change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#showImageData').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});
		
		});
	</script>
    @endsection