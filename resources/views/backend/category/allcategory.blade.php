@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Category</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Category Data</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" data-bs-toggle="modal" data-bs-target="#addDataModal" class="btn btn-primary">Add Category</button>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Categories</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Category Name</th>
										<th>Category Image</th>
										<th>Category Logo</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="tbodyData">
 
                                   
								</tbody>
								<tfoot>
									<tr>
										<th>Sl</th>
										<th>Category Name</th>
										<th>Category Image</th>
										<th>Category Logo</th>
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
						  <h5 class="modal-title">Add Category</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Category Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="category_name" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Category Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="category_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImageCat" alt="Admin" width="110">
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Category Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="category_image_logo" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImageCatLogo" alt="Admin" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="category_status" aria-label="Default select example">
										<option selected="">Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="add_category">Add Category</button>
							</div>
						
					  </div>
					</div>
				  </div>

				  <!-- To Update Data -->
				<div class="modal" tabindex="-1" id="updateModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Update Category</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Category Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_category_name" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Category Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="edit_category_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="edit_showImageCat" alt="Admin" width="110">
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Category Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="edit_category_image_logo" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="edit_showImageCatLogo" alt="Admin" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_category_status" aria-label="Default select example">
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
							
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="update_category">Update</button>
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
	<script src="{{asset('adminBackend')}}/assets/js/AdminCategoryAjax.js"></script>
    <script type="text/javaScript">
		$(document).ready(function(e) {

			$(document).on("click","#category_image",function(){
					$('#category_image').change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#showImageCat').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});
			$(document).on("click","#category_image_logo",function(){
					$('#category_image_logo').change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#showImageCatLogo').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});	
			$(document).on("click","#edit_category_image",function(){
					$('#edit_category_image').change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#edit_showImageCat').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});
			$(document).on("click","#edit_category_image_logo",function(){
					$('#edit_category_image_logo').change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#edit_showImageCatLogo').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});	
		});
        </script>
    @endsection