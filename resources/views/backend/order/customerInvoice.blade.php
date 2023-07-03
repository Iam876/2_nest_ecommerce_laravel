<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: #3BB77E;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: #3BB77E;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: #3BB77E; font-size: 26px;"><strong>Nest Ecommerce</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               Nest Ecommerce
               Email:imuhammad784@gmail.com <br>
               Mob: 1245454545 <br>
               Dhaka Bangladesh <br>

            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    @foreach($orders as $orderProduct)
    @endforeach
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> {{$orderProduct->name}} <br>
           <strong>Email:</strong> {{$orderProduct->email}} <br>
           <strong>Phone:</strong> {{$orderProduct->phone}} <br>

           <strong>Address:</strong> {{$orderProduct->adress}},{{$orderProduct->state->state_name}},{{$orderProduct->district->district_name}},{{$orderProduct->division->division_name}} <br>
           <strong>Post Code:</strong> {{$orderProduct->post_code}}
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: #3BB77E;">Invoice:</span> #{{$orderProduct->invoice_no}}</h3>
            Order Date: {{$orderProduct->order_date}} <br>
             Delivery Date:  <br>
            Payment Type : @php
                                $paymentType = $orderProduct->payment_type;
                                $paymentType = str($paymentType)->replace('Stripe : ', '')->ucfirst()->toString();
                           @endphp

                            {{ $paymentType }}  </span>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>


  <table width="100%">
    <thead style="background-color: #3BB77E; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
      </tr>
    </thead>
    <tbody>

        @foreach($orderItem as $order)
            <tr class="font">
                <td align="center">
                    {{-- <img src="{{asset($order->product->product_thumbnail)}}" height="60px;" width="60px;" alt=""> --}}
                </td>
                <td align="center">{{$order->product->product_name}}</td>
                <td align="center">

                </td>
                <td align="center">
                    @if ($order->product->product_color === 'Red,#3BB77E,Blue,Yellow')
                    @php
                    $color = explode(',', $order->product->product_color);
                    $randomColorIndex = array_rand($color);
                    $randomColorItem = $color[$randomColorIndex];
                    @endphp
                    {{$randomColorItem}} 
                    @else
                        {{$order->product->product_color}}
                    @endif 
                </td>
                <td align="center">{{$order->product->product_code}}</td>
                <td align="center">{{$order->qty}}</td>
                <td align="center">${{$order->price}}</td>
                <td align="center">${{$order->price * $order->qty}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: #3BB77E;">Subtotal:</span> ${{$orderProduct->amount}}</h2>
            <h2><span style="color: #3BB77E;">Total:</span> ${{$orderProduct->amount}}</h2>
            {{-- <h2><span style="color: #3BB77E;">Full Payment PAID</h2> --}}
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p style="font-style: italic;color:#3BB77E;font-weight: bold">Nest Ecommerce</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>