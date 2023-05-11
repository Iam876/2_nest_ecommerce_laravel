@extends('vendor.vendorMasterDashboard')
    
    @section('main-content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <main class="main pages">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Products</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

          <div class="card">
              <div class="card-body p-4">
                  <h5 class="card-title">Add New Product</h5>
                  <hr/>
                    <form action="{{Route('update_products_vendor',$products->id)}}" method="POST">
                            @csrf
                        <div class=" mt-4">
                            <div class="row">
                            <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" value="{{$products->product_name}}" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductTags" class="form-label">Product Tags</label>
                                    <input type="text" class="form-control visually-hidden" name="product_tags" id="inputProductTags" data-role="tagsinput" value="{{$products->product_tags}}">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductSize" class="form-label">Product Size</label>
                                    <input type="text" class="form-control visually-hidden" name="product_size" id="inputProductSize" data-role="tagsinput" value="{{$products->product_size}}">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductColor" class="form-label">Product Color</label>
                                    <input type="text" class="form-control visually-hidden" name="product_color" id="inputProductColor" data-role="tagsinput" value="{{$products->product_color}}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="ShortDescription" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_descp" id="ShortDescription" rows="3">{{$products->short_descp}}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="Long_Description" class="form-label">Long  Description</label>
                                    <textarea class="form-control" name="long_descp" id="Long_Description" rows="3">{{$products->long_descp}}</textarea>
                                </div>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Selling Price</label>
                                        <input type="number" class="form-control" name="selling_price" value="{{$products->selling_price}}" id="inputPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                        <input type="number" class="form-control" name="discount_price" value="{{$products->discount_price}}" id="inputCompareatprice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                        <input type="text" class="form-control" name="product_code" value="{{$products->product_code}}" id="inputCostPerPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStarPoints" class="form-label">Product Quentity</label>
                                        <input type="number" class="form-control" name="product_qty" value="{{$products->product_qty}}" id="inputStarPoints" placeholder="00.00">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputProductType" class="form-label">Product Brand</label>
                                        <select class="form-select" name="brand_id" id="inputProductType">
                                            <option>Select Brand</option>
                                            @foreach($brand as $brand)
                                            <option value="{{$brand->id}}" {{$brand->id == $products->brand_id ? 'selected': ''}}>{{$brand->brand_name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputVendor" class="form-label">Product Category</label>
                                        <select class="form-select" name="category_id" id="category_id">
                                            <option>Select Category</option>
                                            @foreach($category as $cat)
                                            <option value="{{$cat->id}}" {{$cat->id == $products->category_id ? 'selected': ''}}>{{$cat->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCollection" class="form-label">Product Subcategory</label>
                                        <select class="form-select" name="subcategory_id" id="subcategory_id">
                                            @foreach($subCategory as $subcat)
                                            <option value="{{$subcat->id}}" {{$subcat->id == $products->subcategory_id ? 'selected':''}}>{{$subcat->subcategory_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCollectionVendor" class="form-label">Select Vendor</label>
                                        <select class="form-select" name="vendor_id" id="inputCollectionVendor">
                                            @if($products != '' && $vendor!= '')
                                            <option value="{{$products->vendor_id}}">{{$vendor->name}}</option>
                                            @endif
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row g-1">
                                            <div class="form-check col-6">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="hot_deals" {{$products->hot_deals == 1? 'checked' : ''}}>
                                                <label class="form-check-label" for="hot_deals">Hot Deals</label>
                                            </div>
                                            <div class="form-check col-6">
                                                <input class="form-check-input" type="checkbox" value="1" name="featured" id="featured" {{$products->featured == 1? 'checked' : ''}}>
                                                <label class="form-check-label" for="featured">Featured</label>
                                            </div>
                                            <div class="form-check col-6">
                                                <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="special_deals" {{$products->special_deals == 1? 'checked' : ''}}>
                                                <label class="form-check-label" for="special_deals">Special Deals</label>
                                            </div>
                                            <div class="form-check col-6">
                                                <input class="form-check-input" type="checkbox" value="1" name="special_offer" id="special_offer" {{$products->special_offer == 1? 'checked' : ''}}>
                                                <label class="form-check-label" for="special_offer">Special Offer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Update Product</button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                        </div><!--end row-->
                        </div>
                    </form>
              </div>
          </div>
          <div class="card">
            <div class="p-4">
                <h5 class="card-title">Update Main Image Thumbnail</h5>
                  <hr/>
                  <form action="{{Route('update_mainThumbnail_vendor',$products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Product Thumbnail</label>
                        <input class="form-control" name="product_thumbnail" type="file" id="formFile" onchange="MainThumbUrl(this)">
                        <img src="{{asset($products->product_thumbnail)}}" width="100px" height="100px" id="mainThumb" alt="">
                    </div>
                    <div class="col-2">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Thumbnail</button>
                        </div>
                    </div>
                  </form>
              </div>
          </div>
          <div class="card">
            <div class="p-4">
                <h5 class="card-title">Update Multi Images</h5>
                  <hr/>
                  <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#Sl</th>
                            <th scope="col">Image</th>
                            <th scope="col">Change Image </th>
                            <th scope="col">Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                  <form action="{{Route('update_multiImages_vendor',$products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @php
                        $id = 1;
                    @endphp
                    @foreach($multiImage as $mImg)
                    <tr>
                        <td>{{$id++}}</td>
                        <td><img src="{{asset($mImg->photo_name)}}" width="100px" alt=""></td>
                        <td> <input type="file" class="form-group" name="multi_img[{{ $mImg->id }}]"> </td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm">UPDATE IMAGE</button>
                            <a href="{{Route('delete_multi_images_vendor',$mImg->id)}}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                    @endforeach
                  </form>
                </tbody>
                </table>
              </div>
          </div>
        </div>
        <script type="text/javaScript">
            function MainThumbUrl(input) {
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#mainThumb").attr('src',e.target.result).width(80).height(80);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <script>
            $(document).ready(function(){
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
            })
        </script>
        <script>
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
            });
        </script>
    </main>
    @endsection