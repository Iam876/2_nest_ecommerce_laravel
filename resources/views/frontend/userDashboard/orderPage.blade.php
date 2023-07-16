    <!--End header-->
    @extends('dashboardMaster')
    @section('title')
    Dashborad | Order
    @endsection
    <!--End header-->
    @section('dashboard')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Order
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            {{-- Menu Start --}}
                            @include('frontend.layouts.UserDashboardSideBar')
                            {{-- Menu End --}}
                            <div class="col-md-9">
                                
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Date</th>
                                                            <th>Invoice</th>
                                                            <th>Payment Method</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Quantity</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                         $id = 1;
                                                        @endphp
                                                        @foreach ($orders as $order)
                                                       <tr>
                                                                <td>{{$id++}}</td>
                                                                <td>{{$order->order_date}}</td>
                                                                <td>{{$order->invoice_no}}</td>
                                                                <td>
                                                                    @php
                                                                        $paymentType = $order->payment_type;
                                                                        $paymentType = str($paymentType)->replace('Stripe : ', '')->ucfirst()->toString();
                                                                    @endphp
                                                                
                                                                    {{ $paymentType }}
                                                                </td>
                                                                
                                                                <td>
                                                                    
                                                                   @if ($order->status == 'pending')       
                                                                        @if($order->cancel_status == 1)
                                                                            <span class="badge bg-warning">Cancel progressing</span>
                                                                        @elseif($order->cancel_status == 2)
                                                                            <span class="badge bg-danger">Canceled</span>
                                                                        @else
                                                                            <span class="badge bg-primary">pending</span>
                                                                        @endif
                                                                   @elseif($order->status == 'confirmed')
                                                                        <span class="badge bg-secondary">Confirm</span>
                                                                   @elseif($order->status == 'processing')
                                                                        <span class="badge bg-info">Processing</span>
                                                                   @elseif($order->status == 'delivered')
                                                                        @if($order->return_status == 1)
                                                                            <span class="badge bg-warning">Return progressing</span>
                                                                        @elseif($order->return_status == 2)
                                                                            <span class="badge bg-danger">Returned</span>
                                                                        @else
                                                                            <span class="badge bg-success">Delivered</span>
                                                                        @endif
                                                                        
                                                                   @endif
                                                                </td>
                                                                <td>${{$order->amount}}</td>
                                                                <td>{{$order->OrderItem->sum('qty')}}</td>
                                                                <td><a href="{{url('/user/orderDetails/page/'.$order->id)}}" class="btn btn-sm btn-primary mx-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                      </svg>
                                                                </a><a href="{{url('/user/orderInvoice/page/'.$order->id)}}" class="btn btn-sm btn-secondary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                                                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                                                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                                      </svg>
                                                                </a></td>
                                                            </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection