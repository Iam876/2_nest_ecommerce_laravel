@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Banner</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Banner</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" data-bs-toggle="modal" data-bs-target="#addDataModal" class="btn btn-primary">Add banner</button>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Banner</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Banner Title</th>
										<th>Banner Url</th>
										<th>Banner Image</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="tbodyData">
 
                                   
								</tbody>
								<tfoot>
									<tr>
                                    <th>Sl</th>
										<th>Banner Title</th>
										<th>Banner Url</th>
										<th>Banner Image</th>
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
						  <h5 class="modal-title">Add Banner</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Banner Title</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="banner_title" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Banner Url</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="banner_url" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Banner Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="banner_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImagebanner" alt="" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="banner_status" aria-label="Default select example">
										<option selected="">Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="add_banner">Add Banner</button>
							</div>
						
					  </div>
					</div>
				  </div>

				  <!-- To Update Data -->
				<div class="modal" tabindex="-1" id="updateModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Update banner</h5>
						</div>
						<div class="modal-body">

							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">banner Title</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_banner_title" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">banner Url</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_banner_url" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">banner Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="edit_banner_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImagebanner" alt="" width="110">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="edit_showImagebanner" alt="" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_banner_status" aria-label="Default select example">
										<option selected="">Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>	
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="update_banner">Update</button>
							</div>
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
	<script src="{{asset('adminBackend')}}/assets/js/AdminbannerAjax.js"></script>
     <script type="text/javaScript">
		$(document).ready(function(e) {

			$(document).on("click","#banner_image",function(){
					$('#banner_image').change(function(e){
					var reader = new FileReader();
					reader.onload=function(e) {
						$('#showImagebanner').attr('src',e.target.result);
					}
					reader.readAsDataURL(e.target.files['0']);
				});
			});
        });
        </script> 
    @endsection