@extends('vendor.vendorMasterDashboard')
    
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
												<td>{{($vendorOrder->price)*($vendorOrder->qty)}}</td>
												{{-- <td>{{$vendorOrder->orderItem->amount}}</td> --}}
												<td>{{$vendorOrder->orderItem->payment_type}}</td>
												<td>
													@if ($vendorOrder->orderItem->status == 'confirmed' && $vendorOrder->orderItem->return_status == NULL)
													<span class="badge rounded-pill bg-light-primary text-primary w-50">Confirmed</span>
													@elseif($vendorOrder->orderItem->status == 'pending' && $vendorOrder->orderItem->return_status == NULL)
													<span class="badge rounded-pill bg-light-info text-info w-50">Pending</span>
													@elseif($vendorOrder->orderItem->status == 'processing' && $vendorOrder->orderItem->return_status == NULL)
													<span class="badge rounded-pill bg-light-info text-info w-50">Processing</span>
													@elseif($vendorOrder->orderItem->status == 'delivered' && $vendorOrder->orderItem->return_status == NULL)
													<span class="badge rounded-pill bg-light-success text-success w-50">Delivered</span>
													@elseif($vendorOrder->orderItem->return_status == 1)
													<span class="badge rounded-pill bg-light-warning text-warning w-50">Return Processing</span>
													<span class="badge rounded-pill bg-light-success text-success w-50">Delivered</span>
													@elseif($vendorOrder->orderItem->return_status == 2)
													<span class="badge rounded-pill bg-light-danger text-danger w-50">Returned</span>
													@endif
												</td>
													{{-- <span class="btn btn-outline-primary btn-sm">{{$vendorOrder->orderItem->status}}</span></td> --}}
												<td>
													<a href="{{Route('vendor.userOrderInfo',$vendorOrder->orderItem->id)}}" class="btn btn-primary">View</a>
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
    </main>
    @endsection