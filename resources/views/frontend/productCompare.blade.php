@extends('frontend.frontendMaster')
@section('title')
Compare Page
@endsection
    <!--End header-->
    @section('main-section')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop <span></span> Compare
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <h1 class="heading-2 mb-10">Products Compare</h1>
                    <h6 class="text-body mb-40">There are <span class="text-brand" id="CompareTotal"></span> products to compare</h6>
                    <div class="table-responsive">

                        <div class="compare-table-container d-flex">
                            <table class="table compare-header" style="width: 10%">
                              <tbody>
                                  <tr><td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Name</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Price</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Rating</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Description</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Stock status</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Size</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Color</td></tr>
                                  <tr><td class="text-muted font-sm fw-600 font-heading">Buy now</td></tr>
                                  <th class="text-muted font-md fw-600">Delete</th>
                              </tbody>
                            </table>
                          
                            <table class="table text-center table-compare" style="width: 90%">
                              <tbody>
                                <tr class="pr_image"></tr>
                                <tr class="pr_title"></tr>
                                <tr class="pr_price"></tr>
                                <tr class="pr_rating"></tr>
                                <tr class="description"></tr>
                                <tr class="pr_stock"></tr>
                                <tr class="pr_size"></tr>
                                <tr class="pr_color"></tr>
                                <tr class="pr_add_to_cart"></tr>
                                <tr class="pr_remove text-muted"></tr>
                              </tbody>
                            </table>
                          </div>
                          
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection