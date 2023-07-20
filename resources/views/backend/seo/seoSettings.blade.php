@extends('admin.adminMasterDashboard')
@section('title')
    Admin | Seo Settings
@endsection
    
    @section('main-content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Seo Update</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Seo Data Update</h6>
				<hr/>
				<div class="card col-md-6">
					<div class="card-body">
                        <div class="p-4 border rounded">
                            <form class="row" method="POST" action="{{route('seo.settings.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="meta_title" class="form-label">Meta title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Enter Instagram Full URL" value="{{$seo->meta_title}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="meta_author" class="form-label">Meta author</label>
                                    <input type="text" id="meta_author" name="meta_author" class="form-control" placeholder="Enter Pinterest Full URL" value="{{$seo->meta_author}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="meta_keyword" class="form-label">Meta keyword</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Enter Copyright Text" value="{{$seo->meta_keyword}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="meta_description" class="form-label">Meta description</label>
                                    <input type="text" id="meta_description" name="meta_description" class="form-control" placeholder="Enter Offer Message" value="{{$seo->meta_description}}">
                                </div>
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Save Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>			 
			</div>
    </main>
    @endsection