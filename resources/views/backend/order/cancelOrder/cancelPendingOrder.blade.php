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
									@if (count($cancel_pending)>0)
										@foreach ($cancel_pending as $CancelpendingOrder)
											<tr>
												<td>{{$no++}}</td>
												<td>{{$CancelpendingOrder->order_date}}</td>
												<td>{{$CancelpendingOrder->invoice_no}}</td>
												<td>{{$CancelpendingOrder->amount}}</td>
												<td>{{$CancelpendingOrder->payment_type}}</td>
												<td>{{$CancelpendingOrder->cancel_date}}</td>
												<td>{{$CancelpendingOrder->cancel_reason}}</td>
												<td>
                                                    @if ($CancelpendingOrder->cancel_status == 1)
                                                    <span class="btn btn-warning btn-sm">Cancel Progressing</span>
                                                    @else
                                                        
                                                    @endif
                                                </td>
												<td>
													<a href="{{Route('pending.cancel.order',$CancelpendingOrder->id)}}" class="btn btn-primary">EDIT</a>
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