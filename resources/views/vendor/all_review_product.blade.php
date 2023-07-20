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
                                        <th>Product Name</th>
                                        <th>Vendor Name</th>
                                        <th>Rating</th>
                                        <th>Status</th> 
                                        <th>Replay</th> 
									</tr>
								</thead>
								<tbody>
                                    @foreach ($allProductReview as $key => $productReview)
                                        <tr>
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$productReview->user->username}}</td>
                                                <td>{{ Str::limit($productReview->comment, 70) }}</td>
                                                <td>{{$productReview->products->product_name}}</td>
                                                <td>{{$productReview->vendor->username}}</td>
                                                <td>{{$productReview->rating}}</td>
                                                <td>
                                                    @if ($productReview->status==1)
                                                        <span class="btn btn-success">Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Replay</a>
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
                                        <th>Product Name</th>
                                        <th>Vendor Name</th>
                                        <th>Rating</th>
                                        <th>Status</th> 
                                        <th>Replay</th> 
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>				 
			</div>
    </main>
    @endsection