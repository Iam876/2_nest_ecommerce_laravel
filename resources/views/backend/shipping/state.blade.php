@extends('admin.adminMasterDashboard')
@section('title')
Admin | All State
@endsection
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">State</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All State Data</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" data-bs-toggle="modal" data-bs-target="#addStateModal" class="btn btn-primary" id="StateClicked" >Add State</button>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Coupon</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Division Name</th>
										<th>District Name</th>
										<th>State Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="tbodyData">
 
                                   
								</tbody>
								<tfoot>
									<tr>
										<th>Sl</th>
										<th>Division Name</th>
										<th>District Name</th>
										<th>State Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

				<!-- Modal To Add Data -->
				<div class="modal" tabindex="-1" id="addStateModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Add State</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">State Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="state_name" class="form-control" placeholder="Enter State Name" value=""/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select Division</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="division_name"  aria-label="Default select example">
										 
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select District</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="district_name"  aria-label="Default select example">
										 
									</select>
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="state_status" aria-label="Default select example">
										<option selected="">Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="add_state">Add State</button>
							</div>
						
					  </div>
					</div>
				  </div>

				  <!-- To Update Data -->
				{{-- <div class="modal" tabindex="-1" id="updateModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Update State</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">State Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_state_name" class="form-control" value=""/>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select Division</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_division_name"  aria-label="Default select example">
										 
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select District</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_district_name"  aria-label="Default select example">
										 
									</select>
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_coupon_status" aria-label="Default select example">
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
							
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="update_state">Update</button>
							</div>
					  </div>
					</div>
				  </div> --}}

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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://moment.github.io/luxon/global/luxon.min.js"></script>	
	<script src="{{asset('adminBackend')}}/assets/js/shipStateAjax.js"></script>
    <script type="text/javaScript">
        </script>
    @endsection