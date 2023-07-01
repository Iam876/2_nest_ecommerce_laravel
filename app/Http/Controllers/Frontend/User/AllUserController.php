<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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
}