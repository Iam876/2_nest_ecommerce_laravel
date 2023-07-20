@extends('admin.adminMasterDashboard')
@section('title')
    Admin | Reports with Dates
@endsection
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">User Order</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User order Data</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
                <div class="card w-50">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Full Dates</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Months</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-microphone font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Years</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                                <div class="mb-3">
									<label class="form-label">Pick a Date</label>
									<input type="text" class="form-control datepicker" value="" placeholder="Enter Full Year"/>
                                    <button class="btn btn-primary btn-sm" id="fullDate">submit</button>
								</div>
                            </div>
                            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                <div class="mb-3">
									<label class="form-label">Pick a Month</label>
									<input type="text" class="form-control pickmonth" value="" placeholder="Enter a month" />
                                    <button class="btn btn-primary btn-sm" id="Searchmonth">submit</button>
								</div>
                            </div>
                            <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                <div class="mb-3">
									<label class="form-label">Pick a Date</label>
									<input type="text" class="form-control picyear" value="" placeholder="Enter a year" />
                                    <button class="btn btn-primary btn-sm" id="Searchyear">submit</button>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
				<h6 class="mb-0 text-uppercase">Categories</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>id</th>
										<th>User Name</th>
										<th>Date</th>
                                        <th>Invoice</th>
										<th>Amounts</th>
										<th>Payment</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody class="DateData">
 
                                   
								</tbody>
								<tfoot>
									<tr>
										<th>Sl</th>
										<th>id</th>
										<th>User Name</th>
										<th>Date</th>
                                        <th>Invoice</th>
										<th>Amounts</th>
										<th>Payment</th>
										<th>Status</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
    </main>

	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{asset('adminBackend')}}/assets/js/OrderReports.js"></script>
    <script>
    </script>
    @endsection