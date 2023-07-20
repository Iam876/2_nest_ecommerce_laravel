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
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
                                        <th>Sl</th>
                                        <th>Username</th>
                                        <th>Comment</th>
                                        <th>Vendor Name </th>
                                        <th>Product Name</th>
                                        <th>Rating</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
									</tr>
								</thead>
								<tbody>
                                    @foreach ($activeReviewProducts as $key => $activeReview)
                                        <tr>
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$activeReview->user->username}}</td>
                                                <td>{{ Str::limit($activeReview->comment, 70) }}</td>
                                                <td>{{$activeReview->vendor->username}}</td>
                                                <td>{{$activeReview->products->product_name}}</td>
                                                <td>{{$activeReview->rating}}</td>
                                                <td>
                                                    @if ($activeReview->status==1)
                                                        <a href="{{Route('inactive.product',$activeReview->id)}}"class="btn btn-success">Active</a>    
                                                    @endif
                                                </td>
                                            </tr>
                                        </tr>
                                    @endforeach
								</tbody>
								<tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Username</th>
                                        <th>Comment</th>
                                        <th>Vendor Name </th>
                                        <th>Product Name</th>
                                        <th>Rating</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

				  <!-- To Delete Data -->
				{{-- <div class="modal" tabindex="-1" id="OpenDelete">
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
								<button class="btn btn-danger px-4 " id="delete_product">Delete</button>
							</div>
						
					  </div>
					</div>
				</div> --}}
				 
			</div>
    </main>
    @endsection