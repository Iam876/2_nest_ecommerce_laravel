@extends('admin.adminMasterDashboard')
@section('title')
    Admin | Add Blog
@endsection
    
    @section('main-content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <main class="main pages">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Blog Post</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

          <div class="card">
              <div class="card-body p-4">
                  <h5 class="card-title">Add New Blog</h5>
                  <hr/>
                  <form action="{{Route('store_blogs')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class=" mt-4">
                    <div class="row">
                       <div class="col-lg-8">
                       <div class="border border-3 p-4 rounded">
                        <div class="mb-3">
                            <label for="inputBlogTitle" class="form-label">Blog Name</label>
                            <input type="text" name="blog_title" class="form-control" id="inputBlogTitle" placeholder="Enter blog title">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Blog Thumbnail</label>
                            <input class="form-control" name="blog_thumbnail" type="file" id="formFile" onchange="MainThumbUrl(this)">
                            <img src="" id="mainThumb" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="Long_Description" class="form-label">Long  Description</label>
                            <textarea class="form-control" name="long_descp" id="Long_Description" rows="3"></textarea>
                          </div>
                        <div class="mb-3">
                            <label for="inputBlogTags" class="form-label">Blog Tags</label>
                            <input type="text" class="form-control visually-hidden" name="blog_tags" id="inputBlogTags" data-role="tagsinput" value="">
                        </div>
                        <div class="mb-3">
                            <select class="form-select mb-3" name="category" required>
                                <option selected="">Choose Category</option>
                                @foreach ($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->blog_category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-100">Add</button>
                        </div>
                        </div>
                       </div>
                      </div>
                   </div><!--end row-->
                </div>
            </form>
              </div>
            
          </div>

        </div>
        <script>
            function MainThumbUrl(input) {
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#mainThumb").attr('src',e.target.result).width(80).height(80);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(document).ready(function(){
                $(document).on("click","#category_id",function(){
                    var cat_id = $(this).val();
                    if(cat_id){
                        $.ajax({
                            url: '/subcategory/values/'+cat_id,
                            type:"GET",
                            success: function(response){
                                if(response.status == 200){
                                    var Data = '';
                                    $.each(response.AllData,function(key,val){
                                       Data+= '<option value="'+val.id+'">'+val.subcategory_name+'</option>';
                                    });
                                    $("#subcategory_id").html(Data);
                                }
                            }
                        });
                    }
                });
                $('#multiImage').on('change', function(){ //on file input change
                    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                    {
                        var data = $(this)[0].files; //this file data
                        
                        $.each(data, function(index, file){ //loop though each file
                            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                                var fRead = new FileReader(); //new filereader
                                fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                                .height(80); //create image element 
                                    $('#preview_multi_image').append(img); //append image to output element
                                };
                                })(file);
                                fRead.readAsDataURL(file); //URL representing the file's data.
                            }
                        });
                        
                    }else{
                        alert("Your browser doesn't support File API!"); //if File API is absent
                    }
                });
            });
        </script>
    </main>
    @endsection