<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Http\Request;

class CancelReturnProductController extends Controller
{
    // Canceled Part
    public function CancelOrderManage()
    {
        $cancel_pending =  Order::where('cancel_status', 1)->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.cancelOrder.cancelPendingOrder', compact('cancel_pending'));
    }
    public function PendingCancelOrder($id)
    {
        $orders = Order::where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();
        return view('backend.order.cancelOrder.cancelStatusPage', compact('orders', 'orderItem'));
    }

    public function ConfirmCancelOrder($id)
    {
        Order::findOrFail($id)->update([
            'cancel_status' => 2,
            'status' => 'Canceled',
        ]);
        $notification = array(
            'message' => 'Cancel confirmed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('Confirm.canceled.order.manage')->with($notification);
    }

    public function ConfirmManageList()
    {
        $cancel_confirm =  Order::where('cancel_status', 2)->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.cancelOrder.canceled', compact('cancel_confirm'));
    }

    public function CancelDeleteOrder($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back();
    }

    // Return Part
    public function ReturnOrderManage()
    {
        $return_pending =  Order::where('return_status', 1)->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.returnOrder.returnPendingOrder', compact('return_pending'));
    }
    public function PendingReturnOrder($id)
    {
        $orders = Order::where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();
        return view('backend.order.returnOrder.returnStatusPage', compact('orders', 'orderItem'));
    }

    public function ConfirmReturnOrder($id)
    {
        Order::findOrFail($id)->update([
            'return_status' => 2,
            'status' => 'Canceled',
        ]);
        $notification = array(
            'message' => 'Return confirmed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('Confirm.returned.order.manage')->with($notification);
    }

    public function ConfirmReturnManageList()
    {
        $return_confirm =  Order::where('return_status', 2)->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.returnOrder.returned', compact('return_confirm'));
    }

    public function ReturnDeleteOrder($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back();
    }
}