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
                            <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

          <div class="card">
              <div class="card-body p-4">
                  <h5 class="card-title">Add New Product</h5>
                  <hr/>
                  <form action="{{Route('store_products_vendor')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class=" mt-4">
                    <div class="row">
                       <div class="col-lg-8">
                       <div class="border border-3 p-4 rounded">
                        <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                        </div>
                        <div class="mb-3">
                            <label for="inputProductTags" class="form-label">Product Tags</label>
                            <input type="text" class="form-control visually-hidden" name="product_tags" id="inputProductTags" data-role="tagsinput" value="fashion,health,beauty">
                        </div>
                        <div class="mb-3">
                            <label for="inputProductSize" class="form-label">Product Size</label>
                            <input type="text" class="form-control visually-hidden" name="product_size" id="inputProductSize" data-role="tagsinput" value="Small,Medium,Large">
                        </div>
                        <div class="mb-3">
                            <label for="inputProductColor" class="form-label">Product Color</label>
                            <input type="text" class="form-control visually-hidden" name="product_color" id="inputProductColor" data-role="tagsinput" value="Red,Green,Blue,Yellow">
                        </div>
                         
                          <div class="mb-3">
                            <label for="ShortDescription" class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_descp" id="ShortDescription" rows="3"></textarea>
                          </div>

                          <div class="mb-3">
                            <label for="Long_Description" class="form-label">Long  Description</label>
                            <textarea class="form-control" name="long_descp" id="Long_Description" rows="3"></textarea>
                          </div>

                          <div class="mb-3">
                            <label for="formFile" class="form-label">Product Thumbnail</label>
                            <input class="form-control" name="product_thumbnail" type="file" id="formFile" onchange="MainThumbUrl(this)">
                            <img src="" id="mainThumb" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="multiImage" class="form-label">Product Multiple Images</label>
                            <input class="form-control" type="file" name="multi_img[]" id="multiImage" multiple="">

                            <div class="row" id="preview_multi_image"></div>
                        </div>
                        </div>
                       </div>
                       <div class="col-lg-4">
                        <div class="border border-3 p-4 rounded">
                          <div class="row g-3">
                            <div class="col-md-6">
                                <label for="inputPrice" class="form-label">Selling Price</label>
                                <input type="number" class="form-control" name="selling_price" id="inputPrice" placeholder="00.00">
                              </div>
                              <div class="col-md-6">
                                <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                <input type="number" class="form-control" name="discount_price" id="inputCompareatprice" placeholder="00.00">
                              </div>
                              <div class="col-md-6">
                                <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                <input type="text" class="form-control" name="product_code" id="inputCostPerPrice" placeholder="00.00">
                              </div>
                              <div class="col-md-6">
                                <label for="inputStarPoints" class="form-label">Product Quentity</label>
                                <input type="number" class="form-control" name="product_qty" id="inputStarPoints" placeholder="00.00">
                              </div>
                              <div class="col-12">
                                <label for="inputProductType" class="form-label">Product Brand</label>
                                <select class="form-select" name="brand_id" id="inputProductType">
                                    <option>Select Brand</option>
                                    @foreach($brand as $item)
                                    <option value="{{$item->id}}">{{$item->brand_name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="col-12">
                                <label for="inputVendor" class="form-label">Product Category</label>
                                <select class="form-select" name="category_id" id="category_id">
                                    <option>Select Category</option>
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="col-12">
                                <label for="inputCollection" class="form-label">Product Subcategory</label>
                                <select class="form-select" name="subcategory_id" id="subcategory_id">
                                    
                                  </select>
                              </div>
                              <div class="col-12">
                                <label for="inputCollectionVendor" class="form-label">Vendor Name</label>
                                <select class="form-select" name="vendor_id" disabled id="inputCollectionVendor">
                                    <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                                  </select>
                              </div>
                              <div class="col-md-12">
                                <div class="row g-1">
                                    <div class="form-check col-6">
                                        <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                                    </div>
                                    <div class="form-check col-6">
                                        <input class="form-check-input" type="checkbox" value="1" name="featured" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                    </div>
                                    <div class="form-check col-6">
                                        <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                                    </div>
                                    <div class="form-check col-6">
                                        <input class="form-check-input" type="checkbox" value="1" name="special_offer" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                    </div>
                                </div>
                              </div>
                              <div class="col-12">
                                  <div class="d-grid">
                                     <button type="submit" class="btn btn-primary">Save Product</button>
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
                            url: '/subcategory/values/vendor/'+cat_id,
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