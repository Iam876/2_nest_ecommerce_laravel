@extends('admin.adminMasterDashboard')
    
    @section('main-content')
	
    <main class="main pages">
        <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Pending Products</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Pending Products</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Pending Products</h6>
				<hr/>
        @foreach ($orders as $order)
        @endforeach
                <div class="card">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">Order detail {{$order->invoice_no}}</h5>
                      </div>
                      <div class="card-body">
                        <div class="customer-order-detail">
                          <div class="row">
                            <div class="col-auto me-auto">
                              <div class="order-slogan">
                                <img width="100" src="https://nest.botble.com/storage/general/logo.png" alt="Nest - Laravel Multipurpose eCommerce Script">
                                <br>
                              </div>
                            </div>
                            <div class="col-auto">
                              <div class="order-meta">
                                <span class="d-inline-block">Time:</span>
                                <strong class="order-detail-value">{{$order->order_date}}</strong>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 border-top pt-2">
                              <h4>Order information</h4>
                              <div>
                                <div>
                                  <span class="d-inline-block">Order status:</span>
                                  @if ($order->status == 'pending')
                                  <strong class="order-detail-value">Pending</strong>
                                  @elseif($order->status == 'confirmed')
                                      <strong class="order-detail-value">Confirm</strong>
                                  @elseif($order->status == 'processing')
                                      <strong class="order-detail-value">Processing</strong>
                                  @elseif($order->status == 'delivered')
                                      <strong class="order-detail-value">Delivered</strong>
                                  @endif
                                </div>
                                <div>
                                  <span class="d-inline-block">Payment method:</span>
                                  <strong class="order-detail-value"> 
                                    @php
                                        $paymentType = $order->payment_type;
                                        $paymentType = str($paymentType)->replace('Stripe : ', '')->ucfirst()->toString();
                                    @endphp

                                    {{ $paymentType }}  
                                  </strong>
                                </div>
                                <div>
                                  <span class="d-inline-block">Payment status:</span>
                                  @if (($order->payment_type === 'Stripe : card')|| ($order->payment_type === 'Bank'))
                                      <strong class="order-detail-value"> Done</strong>      
                                  @elseif($order->payment_type === 'Cash On Delivery')
                                      <strong class="order-detail-value"> Pending</strong>
                                  @endif
                                </div>
                                <div>
                                  <span class="d-inline-block">Amount:</span>
                                  <strong class="order-detail-value"> ${{$order->amount}} </strong>
                                </div>
                                <div>
                                  <span class="d-inline-block">Tax:</span>
                                  <strong class="order-detail-value"> $0.00 </strong>
                                </div>
                                <div>
                                  <span class="d-inline-block">Discount:</span>
                                  <strong class="order-detail-value"> $0.00

                                  </strong>
                                </div>
                                <div>
                                  <span class="d-inline-block">Shipping fee:</span>
                                  <strong class="order-detail-value">$0.00 </strong>
                                </div>
                              </div>
                              <h4 class="mt-3 mb-1">Customer</h4>
                              <div>
                                <div>
                                  <span class="d-inline-block">Full Name:</span>
                                  <strong class="order-detail-value">{{$order->name}} </strong>
                                </div>
                                <div>
                                  <span class="d-inline-block">Phone:</span>
                                  <strong class="order-detail-value">0978688213 </strong>
                                </div>
                                <div>
                                  <span class="d-inline-block">Email:</span>
                                  <strong class="order-detail-value">{{$order->email}} </strong>
                                </div>
                                <div class="row">
                                  <div class="col-12">
                                    <span class="d-inline-block">Address:</span>
                                    <span class="order-detail-value">{{$order->adress}},{{$order->state->state_name}},{{$order->district->district_name}},{{$order->division->division_name}}-{{$order->post_code}}</span>&nbsp;
                                  </div>
                                </div>
                              </div>
                              <h4 class="mt-3 mb-1">Products</h4>
                              <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Image</th>
                                      <th>Product</th>
                                      <th>Amount</th>
                                      <th class="page_speed_561628599">Quantity</th>
                                      <th class="price text-right">Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                      $no = 1;
                                    @endphp
                                    @foreach($orderItem as $orderitem)
                                      <tr>
                                        <td class="align-middle">{{$no++}}</td>
                                        <td class="align-middle">
                                          <img src="{{asset($orderitem->product->product_thumbnail)}}" width="50" alt="Foster Farms Takeout Crispy Classic">
                                        </td>
                                        <td class="align-middle"> {{$orderitem->product->product_name}} <p>
                                            <small>
                                              Size:
                                              @if ($orderitem->product->product_size === 'Small,Medium,Large')
                                              @php
                                                $size = explode(',', $orderitem->product->product_size);
                                                $randomSizeIndex = array_rand($size);
                                                $randomSizeItem = $size[$randomSizeIndex];
                                              @endphp
                                                  {{$randomSizeItem}} , 
                                              @else
                                                  {{$orderitem->product->product_size}} ,
                                              @endif 
                                              Color:
                                              @if ($orderitem->product->product_color === 'Red,Green,Blue,Yellow')
                                              @php
                                                $color = explode(',', $orderitem->product->product_color);
                                                $randomColorIndex = array_rand($color);
                                                $randomColorItem = $color[$randomColorIndex];
                                              @endphp
                                                {{$randomColorItem}} 
                                              @else
                                                  {{$orderitem->product->product_color}}
                                              @endif 
                                               
                                            </small>
                                          </p>
                                          <p class="d-block mb-0 sold-by">
                                            <small>Sold by: <a href="">
                                              @if ($orderitem->vendor_id == NULL)
                                                  Owner
                                              @else
                                                  {{$orderitem->vendor->name}}
                                              @endif
                                            </a>
                                            </small>
                                          </p>
                                        </td>
                                        <td class="align-middle">${{$orderitem->price}}</td>
                                        <td class="align-middle">{{$orderitem->qty}}</td>
                                        <td class="money text-right align-middle">
                                          <strong> ${{$orderitem->price * $orderitem->qty}} </strong>
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                              <br>
                              <h5>Shipping Information:</h5>
                              <p>
                                <span class="d-inline-block">Shipping Status</span>: <strong class="d-inline-block text-info">
                                  <span class="label-warning status-label">Pending</span>
                                </strong>
                              </p>
                              <div class="mt-2 row">
                                <div class="col-auto me-auto">
                                  <a href="{{url('/user/orderInvoice/page/'.$order->id)}}" class="btn btn-info btn-sm">
                                    <i class="fa fa-download"></i> Download invoice </a>
                                </div>

                                
                                @if($order->status == 'confirm' || $order->status == 'processing')
                                  <div class="col-auto">
                                    <select class="form-select mb-3" aria-label="Default select example">
                                      <option selected="">Return order reason</option>
                                      <option value="Accidental order">Accidental order</option>
                                      <option value="Found a better price elsewhere">Found a better price elsewhere</option>
                                      <option value="Made a duplicate order">Made a duplicate order</option>
                                    </select>
                                    <a href="#HereCancelOrder" class="btn btn-danger btn-sm ml-2">Cancel order</a>
                                  </div>
                                @elseif($order->status == 'delivered')
                                  <div class="col-auto">
                                    <select class="form-select mb-3" aria-label="Default select example">
                                      <option selected="">Return order reason</option>

                                      <option value="Product doesn't match the description">Product doesn't match the description</option>
                                      <option value="Defective or damaged product">Defective or damaged product</option>
                                      <option value="Wrong product received">Wrong product received</option>
                                      <option value="Size/color/style doesn't match">Size/color/style doesn't match</option>
                                      <option value="Received expired product">Received expired product</option>
                                      <option value="Product doesn't meet quality expectations">Product doesn't meet quality expectations</option>
                                      <option value="Received duplicate product">Received duplicate product</option>
                                      <option value="Inaccurate product image">Inaccurate product image</option>
                                    </select>
                                    <a href="#HereCancelOrder" class="btn btn-danger btn-sm ml-2">Return order</a>
                                  </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
    </main>
    @endsection