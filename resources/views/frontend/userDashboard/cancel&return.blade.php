<!--End header-->
@extends('dashboardMaster')
@section('title')
Dashborad | Cancel & Return
    @endsection
<!--End header-->
@section('dashboard')
<main class="main pages">
<div class="page-header breadcrumb-wrap">
<div class="container">
<div class="breadcrumb">
<a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
<span></span> Pages <span></span> Cancel & Return Order
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
                        <th>Cancel Reason</th>
                        <th>Return Reason</th>
                        <th>Total</th>
                        <th>Quantity</th>
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
                                    @if($order->cancel_status == NULL)
                                        <span class="badge bg-success">Not Canceled Yet</span>   
                                    @elseif($order->cancel_status == 1)
                                        <span class="badge bg-warning">Cancel progressing</span>
                                    @elseif($order->cancel_status == 2)
                                        <span class="badge bg-danger">Canceled</span>
                                    @endif
                            </td>
                            <td>
                                @if($order->return_status == NULL)
                                        <span class="badge bg-info">Not Returned Yet</span>   
                                    @elseif($order->return_status == 1)
                                        <span class="badge bg-warning">Return progressing</span>
                                    @elseif($order->return_status == 2)
                                        <span class="badge bg-danger">Returned</span>
                                    @endif
                            </td>
                            <td>${{$order->amount}}</td>
                            <td>{{$order->OrderItem->sum('qty')}}</td>
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