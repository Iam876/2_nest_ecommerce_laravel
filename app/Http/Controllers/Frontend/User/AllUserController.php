<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AllUserController extends Controller
{
    public function UserAccountPage()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userDashboard.accountPage', compact('userData'));
    }

    public function UserOrderPage()
    {
        $id = Auth::User()->id;
        $orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->with('OrderItem')->get();
        return view('frontend.userDashboard.orderPage', compact('orders'));
    }
    public function UserTrackOrderPage()
    {
        return view('frontend.userDashboard.trackOrderPage');
    }
    public function UserTrackDetails(Request $request)
    {
        $id = Auth::user()->id;
        $trackOrder = Order::where('email', $request->billing_email)->where('invoice_no', $request->invoice_no)->where('user_id', $id)->first();
        return view('frontend.orderTrackDetails', compact('trackOrder'));
    }
    public function UserBillingShippingPage()
    {
        return view('frontend.userDashboard.billingShippingPage');
    }
    public function UserChangePasswordPage()
    {
        return view('frontend.userDashboard.changePassword');
    }
    public function UserOrderDetailsPage($id)
    {
        $orders = Order::where('user_id', Auth::id())->where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();
        return view('frontend.userDashboard.orderDetails', compact('orders', 'orderItem'));
    }

    public function UserOrderInvoicePage($id)
    {
        $orders = Order::where('user_id', Auth::id())->where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.userDashboard.userInvoice', compact('orders', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot'  => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    }


    // Cancel & Return Order
    public function CancelReturn()
    {
        $id = Auth::User()->id;
        // $orders = Order::where('user_id', $id)->whereNotNull('return_status')->whereNotNull('cancel_status')->orderBy('id', 'DESC')->with('OrderItem')->get();
        $orders = Order::where('user_id', $id)->where(function ($query) {
            $query->where(function ($subquery) {
                $subquery->whereNotNull('return_status')
                    ->whereNull('cancel_status');
            })->orWhere(function ($subquery) {
                $subquery->whereNull('return_status')
                    ->whereNotNull('cancel_status');
            });
        })->orderBy('id', 'DESC')->with('OrderItem')->get();

        return view('frontend.userDashboard.cancel&return', compact('orders'));
    }
    public function cancelOrder(Request $request, $id)
    {
        Order::findOrFail($id)->update([
            'cancel_date' => Carbon::now()->format('d F Y'),
            'cancel_reason' => $request->cancel_order,
            'cancel_status' => 1
        ]);

        $notification = array(
            'message' => 'Order cancel request sent successfully',
            'alert-type' => 'success'
        );

        return view('frontend.userDashboard.cancel&return')->with($notification);
    }
    public function returnOrder(Request $request, $id)
    {
        Order::findOrFail($id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_status' => 1
        ]);

        $notification = array(
            'message' => 'Return request sent successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('cancel&return.order.page')->with($notification);
    }
}
