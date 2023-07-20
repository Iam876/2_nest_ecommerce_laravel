@extends('admin.adminMasterDashboard')
@section('title')
Admin | All Vendor
@endsection
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Vendors</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Vendors</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Vendors Information</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Avatar</th>
										<th>Username</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Join Date</th>
										<th>Role</th>
										<th>Status</th>
										<th>Is active</th>
									</tr>
								</thead>
								<tbody class="tbody">
                                    @foreach ($active_vendors as $key=>$vendors)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                @if (ctype_digit(substr($vendors->photo,0,1)))
                                                <img src="/upload/vendor-images/{{$vendors->photo}}" class="rounded-pill" width="60px" alt="">
                                                @else
                                                <img src="{{$vendors->photo}}" class="rounded-pill" width="60px" alt="">
                                                @endif
                                            </td>
                                            <td>{{$vendors->username}}</td>
                                            <td>{{$vendors->email}}</td>
                                            <td>{{$vendors->phone}}</td>
                                            <td>{{$vendors->join_date}}</td>
                                            <td><span class="badge badge-sm rounded-pill bg-primary">{{$vendors->role}}</span></td>
                                            <td><span class="badge rounded-pill bg-info text-dark">{{$vendors->status}}</span></td>
                                            <td>
                                                @if ($vendors->UserOnline())
                                                <span class="badge rounded-pill bg-success">Online Now</span>
                                                @else
                                                <span class="badge rounded-pill bg-danger">{{Carbon\Carbon::parse($vendors->is_active)->diffForHumans()}}</span>
                                                @endif
                                            </td>
                                        </tr>  
                                        @endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Sl</th>
										<th>Avatar</th>
										<th>Username</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Join Date</th>
										<th>Role</th>
										<th>Status</th>
										<th>Is active</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>		 
			</div>
    </main>

	</script>
    @endsection