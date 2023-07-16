@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Blog Category</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Blog Category</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <a href="{{Route('add.blog.post')}}" class="btn btn-primary">Add Blog</a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Blog Categories</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered MyDataTable" style="width:100%">
								<thead>
									<tr>
										<th>id</th>
										<th>Cat Name</th>
										<th>Title</th>
										<th>Description</th>
										<th>Thumbnail</th>
										<th>Tags</th>
										<th>Views</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($posts as $key => $post)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$post->BlogCategory->blog_category_name}}</td>
                                        <td>{{$post->post_title}}</td>
                                        <td>{{ Str::limit($post->post_description, 20) }}</td>
                                        <td>
                                            <img src="{{asset($post->post_image)}}" width="60px" alt="">
                                        </td>
                                        <td>{{$post->tags}}</td>
                                        <td>
                                            @if ($post->view_counts == null)
                                                0
                                            @else
                                            {{$post->view_counts}}
                                            @endif</td>
											<td>
													@if($post->status == 'active')
														<a href="{{ route('active.post',$post->id) }}" class="btn btn-sm btn-primary">Active</a>
													@else
														<a href="{{ route('inactive.post',$post->id) }}" class="btn btn-sm btn-secondary">Inactive</a>
													@endif
											</td>
                                        <td>
                                            <a href="{{Route('edit.post',$post->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{$post->id}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#OpenDelete">Delete</a>
                                        </td>
                                   </tr>
								     <!-- To Delete Data -->
				<div class="modal" tabindex="-1" id="OpenDelete">
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

								<a href="{{route('delete.post',$post->id)}}" class="btn btn-danger px-4 ">Delete</a>
							</div>
					  </div>
					</div>
				    </div>
				 
			    </div>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>id</th>
										<th>Cat Name</th>
										<th>Title</th>
										<th>Description</th>
										<th>Thumbnail</th>
										<th>Tags</th>
										<th>Views</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

				<!-- Modal To Add Data -->
				{{-- <div class="modal" tabindex="-1" id="addDataModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Add Category</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Category Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="category_name" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Category Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="category_image_logo" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="showImageCatLogo" alt="Admin" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="category_status" aria-label="Default select example">
										<option selected="">Open this select menu</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="add_category">Add Category</button>
							</div>
						
					  </div>
					</div>
				</div> --}}

				  <!-- To Update Data -->
				{{-- <div class="modal" tabindex="-1" id="updateModal">
					<div class="modal-dialog">
					  <div class="modal-content" id="AddForm myForm">
						<div class="modal-header text-center d-block">
						  <h5 class="modal-title">Update Category</h5>
						</div>
						<div class="modal-body">
							
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0">Category Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" id="edit_category_name" class="form-control" value=""/>
								</div>
							</div>
							<div class="row mb-3" class="form-group">
								<div class="col-sm-3">
									<h6 class="mb-0 text-sm">Category Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" id="edit_category_image_logo" class="form-control"/>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Logo Photo</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<img src="" id="edit_showImageCatLogo" alt="Admin" width="110">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Select</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<select class="form-select mb-3" id="edit_category_status" aria-label="Default select example">
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</div>
							
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button class="btn btn-primary px-4 " id="update_category">Update</button>
							</div>
					  </div>
					</div>
				</div> --}}

				
    </main>
    @endsection