@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Returned Products</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Returned Order</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Pending Products</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Order Date</th>
										<th>Invoice</th>
										<th>Amount</th>
										<th>Payment</th>
										<th>Return Date</th>
										<th>Return Reason</th>
										<th>Return Status</th>
										<th>Action</th> 
									</tr>
								</thead>
								<tbody class="">
									@php
										$no = 1;
									@endphp
									@if (count($return_confirm)>0)
										@foreach ($return_confirm as $Returned)
											<tr>
												<td>{{$no++}}</td>
												<td>{{$Returned->order_date}}</td>
												<td>{{$Returned->invoice_no}}</td>
												<td>${{$Returned->amount}}</td>
												<td>{{$Returned->payment_type}}</td>
												<td>{{$Returned->return_date}}</td>
												<td>{{$Returned->return_reason}}</td>
												<td><span class="btn btn-danger btn-sm">{{$Returned->status}}</span>
                                                </td>
												<td>
													<a href="{{Route('delete.returned.order',$Returned->id)}}" class="btn btn-primary">DELETE</a>
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
										<th>Order Date</th>
										<th>Invoice</th>
										<th>Amount</th>
										<th>Payment</th>
										<th>Return Date</th>
										<th>Return Reason</th>
										<th>Return Status</th>
										<th>Action</th> 
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
    </main>
    @endsection