@extends('admin.adminMasterDashboard')
@section('title')
Admin | Active Vendor
@endsection
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Data Table</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" data-bs-toggle="modal" data-bs-target="#addDataModal" class="btn btn-primary">Add Brand</button>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">DataTable Example</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Id</th>
										<th>Shop Name</th>
										<th>Username</th>
										<th>Email</th>
										<th>Photo</th>
                                        <th>Phone</th>
										<th>Address</th>
										<th>Join Date</th>
										<th>Status</th>
										
									</tr>
								</thead>
								<tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @foreach($ActiveVendor as $vendor)
                                    <tr>
                                        <td>{{$id++}}</td>
                                        <td>{{$vendor->name}}</td>
                                        <td>{{$vendor->username}}</td>
                                        <td>{{$vendor->email}}</td>
                                        <td>
                                            <img src="/upload/vendor-images/{{$vendor->photo}}" width="50px" alt="">
                                        </td>
                                        <td>{{$vendor->phone}}</td>
                                        <td>{{$vendor->address}}</td>
                                        <td>{{ date('F j, Y',strtotime($vendor->join_date))}}</td>
                                        <td>
                                            <a href="{{Route('add.active',$vendor->id)}}" class="btn btn-success btn-sm">{{$vendor->status}}</a>
                                        </td>
                                    </tr>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Id</th>
										<th>Shop Name</th>
										<th>Username</th>
										<th>Email</th>
										<th>Photo</th>
                                        <th>Phone</th>
										<th>Address</th>
										<th>Join Date</th>
                                        <th>Status</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
    </main>
    @endsection