@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Pending Products</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Pending Cancel Order</li>
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
										<th>Cancel Date</th>
										<th>Cancel Reason</th>
										<th>Cancel Status</th>
										<th>Action</th> 
									</tr>
								</thead>
								<tbody class="">
									@php
										$no = 1;
									@endphp
									@if (count($cancel_confirm)>0)
										@foreach ($cancel_confirm as $Canceled)
											<tr>
												<td>{{$no++}}</td>
												<td>{{$Canceled->order_date}}</td>
												<td>{{$Canceled->invoice_no}}</td>
												<td>{{$Canceled->amount}}</td>
												<td>{{$Canceled->payment_type}}</td>
												<td>{{$Canceled->cancel_date}}</td>
												<td>{{$Canceled->cancel_reason}}</td>
												<td><span class="btn btn-danger btn-sm">{{$Canceled->status}}</span>
                                                </td>
												<td>
													<a href="{{Route('delete.canceled.order',$Canceled->id)}}" class="btn btn-primary">DELETE</a>
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
										<th>Cancel Date</th>
										<th>Cancel Reason</th>
										<th>Cancel Status</th>
										<th>Action</th> 
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
    </main>
    @endsection