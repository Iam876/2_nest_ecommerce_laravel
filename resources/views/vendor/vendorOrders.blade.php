@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Vendor Orders</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Orders</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Orders</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
                                        <th>Sl</th>
                                        <th>Date </th>
                                        <th>Invoice </th>
                                        <th>Amount </th>
                                        <th>Payment </th>
                                        <th>State </th>
                                        <th>Action</th> 
                                    </tr>
								</thead>
								<tbody class="">
									@php
										$id = 1;
									@endphp
									@if (count($vendor_order)>0)
										@foreach ($vendor_order as $vendorOrder)
											<tr>
												<td>{{$id++}}</td>
												<td>{{$vendorOrder->orderItem->order_date}}</td>
												<td>{{$vendorOrder->orderItem->invoice_no}}</td>
												<td>{{$vendorOrder->orderItem->amount}}</td>
												<td>{{$vendorOrder->orderItem->payment_type}}</td>
												<td><span class="btn btn-outline-primary btn-sm">{{$vendorOrder->orderItem->status}}</span></td>
												<td>
													<button class="btn btn-primary">Welcome</button>
												</td>
											</tr>
										@endforeach
									@else
										{{ "No Pending Product Found" }}
									@endif   
								</tbody>
								<tfoot>
									<tr>
										<th>Sl</th>
										<th>Date </th>
										<th>Invoice </th>
										<th>Amount </th>
										<th>Payment </th>
										<th>State </th>
										<th>Action</th> 
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

				{{-- <!-- Modal To Add Data -->
				<div class="modal" tabindex="-1" id="addDataModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Add Slider</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Slider Title</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="slider_title" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Slider Short</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="slider_short" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Slider Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="slider_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImageSlider" alt="" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="slider_status" aria-label="Default select example">
										<option selected="">Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="add_slider">Add Slider</button>
							</div>
						
					  </div>
					</div>
				  </div>

				  <!-- To Update Data -->
				<div class="modal" tabindex="-1" id="updateModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Update Slider</h5>
						</div>
						<div class="modal-body">

							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Slider Title</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_slider_title" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Slider Short</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_slider_short" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Slider Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="edit_slider_image" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="edit_showImageSlider" alt="" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_slider_status" aria-label="Default select example">
										<option selected="">Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>	
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="update_slider">Update</button>
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
				 
			</div> --}}
    </main>
    @endsection