<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use App\Notifications\OrderComplete;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class StripeController extends Controller
{
  //
  public function StripeOrder(Request $request)
  {

    if (Session::has('coupon')) {
      $cart_total_amount = Session::get('coupon')['total_amount'];
    } else {
      $cart_total_amount = Cart::getTotal();
    }

    \Stripe\Stripe::setApiKey('sk_test_51NJHbBGRDbWrVouIpcKSXQt7ScGuOulhpBLLWctKTS9DhCQtoaNOFGbpPbdYqxSGmkPM0Vkd8B4FjLBW5zbN8piI00iykueOSc');


    $token = $_POST['stripeToken'];

    $charge = \Stripe\Charge::create([
      'amount' => $cart_total_amount * 100,
      'currency' => 'usd',
      'description' => 'Easy Mulit Vendor Shop',
      'source' => $token,
      'metadata' => ['order_id' => uniqid()],
    ]);
    // dd($charge);

    $order_id = Order::insertGetId([
      'user_id' => Auth::id(),
      'division_id' => $request->division_id,
      'district_id' => $request->district_id,
      'state_id' => $request->state_id,
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'adress' => $request->address,
      'post_code' => $request->post_code,
      'notes' => $request->notes,

      'payment_type' => 'Stripe : ' . $charge->payment_method_details->type,
      'payment_method' => $charge->payment_method,
      'transaction_id' => $charge->balance_transaction,
      'currency' => $charge->currency,
      'amount' => $cart_total_amount,
      'order_number' => $charge->metadata->order_id,

      'invoice_no' => 'EOS' . mt_rand(10000000, 999999999),
      'order_date' => Carbon::now()->format('d F Y'),
      'order_month' => Carbon::now()->format('F'),
      'order_year' => Carbon::now()->format('Y'),
      'status' => 'pending',
      'created_at' => Carbon::now(),
    ]);

    // Start Send Email
    $invoice = Order::findOrFail($order_id);
    $carts = Cart::getContent();
    // $quantity = OrderItem::findOrFail($order_id);
    $data = [
      'invoice_no' => $invoice->invoice_no,
      'amount' => $cart_total_amount,
      // 'quantity' => $quantity->qty,
      // 'address' =>$invoice->adress,
      'name' => $invoice->name,
      'email' => $invoice->email,
    ];

    Mail::to($request->email)->send(new OrderMail($data));
    // End Email


    $user = User::where('role', 'admin')->get();
    foreach ($carts as $cart) {

      OrderItem::insert([
        'order_id' => $order_id,
        'product_id' => $cart->id,
        'vendor_id' => $cart->attributes->vendor,
        'color' => $cart->attributes->color,
        'size' => $cart->attributes->size,
        'qty' => $cart->quantity,
        'price' => $cart->price,
        'created_at' => Carbon::now(),
      ]);
    }



    if (Session::has('coupon')) {
      Session::forget('coupon');
    }

    Cart::clear();
    $notification = array(
      'message' => 'Order Place successfully',
      'alert-type' => 'success'
    );
    Notification::send($user, new OrderComplete($request->name));
    return redirect()->route('user.dashboard')->with($notification);
  }

  public function CodOrder(Request $request)
  {

    $user = User::where('role', 'admin')->get();

    if (Session::has('coupon')) {
      $cart_total_amount = Session::get('coupon')['total_amount'];
    } else {
      $cart_total_amount = Cart::getTotal();
    }

    $order_id = Order::insertGetId([
      'user_id' => Auth::id(),
      'division_id' => $request->division_id,
      'district_id' => $request->district_id,
      'state_id' => $request->state_id,
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'adress' => $request->address,
      'post_code' => $request->post_code,
      'notes' => $request->notes,

      'payment_type' => 'Cash On Delivery',
      'payment_method' => 'Cash On Delivery',

      'currency' => 'USD',
      'amount' => $cart_total_amount,

      'invoice_no' => 'EOS' . mt_rand(10000000, 999999999),
      'order_date' => Carbon::now()->format('d F Y'),
      'order_month' => Carbon::now()->format(' F '),
      'order_year' => Carbon::now()->format(' Y '),
      'status' => 'pending',
      'created_at' => Carbon::now(),
    ]);

    $invoice = Order::findOrFail($order_id);
    // $quantity = OrderItem::findOrFail($order_id);
    $data = [
      'invoice_no' => $invoice->invoice_no,
      'amount' => $cart_total_amount,
      // 'quantity' => $quantity->qty,
      // 'address' =>$invoice->adress,
      'name' => $invoice->name,
      'email' => $invoice->email,
    ];

    Mail::to($request->email)->send(new OrderMail($data));

    $carts = Cart::getContent();

    foreach ($carts as $cart) {

      OrderItem::insert([
        'order_id' => $order_id,
        'product_id' => $cart->id,
        'vendor_id' => $cart->attributes->vendor,
        'color' => $cart->attributes->color,
        'size' => $cart->attributes->size,
        'qty' => $cart->quantity,
        'price' => $cart->price,
        'created_at' => Carbon::now(),
      ]);
    }



    if (Session::has('coupon')) {
      Session::forget('coupon');
    }

    Cart::clear();
    $notification = array(
      'message' => 'Order Place successfully',
      'alert-type' => 'success'
    );
    Notification::send($user, new OrderComplete($request->name));
    return redirect()->route('user.dashboard')->with($notification);
  }
}
