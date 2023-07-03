<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductOrderManagement extends Controller
{
    //
    public function PendingProductManage()
    {
        $pending_order = Order::where('status', 'pending')->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.pendingProduct', compact('pending_order'));
    }
    public function ConfirmProductManage()
    {
        $confirmed_order = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.confirmProduct', compact('confirmed_order'));
    }
    public function ProcessingProductManage()
    {
        $processing_order = Order::where('status', 'processing')->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.processingProduct', compact('processing_order'));
    }
    public function DeliveredProductManage()
    {
        $delivered_order = Order::where('status', 'delivered')->orderBy('id', 'DESC')->latest()->get();
        return view('backend.order.deliveredProduct', compact('delivered_order'));
    }

    public function VendorOrder()
    {
        $id = Auth::user()->id;
        $vendor_order = OrderItem::with('orderItem')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('vendor.vendorOrders', compact('vendor_order'));
    }

    public function PendingStatusPage($id)
    {
        $orders = Order::where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();
        return view('backend.order.OrderStatusPage', compact('orders', 'orderItem'));
    }
    public function PendingToConfirm($id)
    {
        Order::findOrFail($id)->update([
            'confirmed_date' => Carbon::now()->format('d F Y'),
            'status' => 'confirmed',
        ]);
        $notification = array(
            'message' => 'Order confirmed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('Confirm.order.manage')->with($notification);
    }


    public function ConfirmedStatusPage($id)
    {
        $orders = Order::where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();
        return view('backend.order.OrderStatusPage', compact('orders', 'orderItem'));
    }
    public function ConfirmedToProcessing($id)
    {
        Order::findOrFail($id)->update([
            'processing_date' => Carbon::now()->format('d F Y'),
            'status' => 'processing',
        ]);
        $notification = array(
            'message' => 'Order Processed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('Processing.order.manage')->with($notification);
    }


    public function ProcessingStatusPage($id)
    {
        $orders = Order::where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();
        return view('backend.order.OrderStatusPage', compact('orders', 'orderItem'));
    }
    public function ProcessingToDelivered($id)
    {
        $order = Order::findOrFail($id);

        if ($order->transaction_id === null || $order->transaction_id == '') {
            $transaction_cod = Str::random(24);

            $order->update([
                'delivered_date' => Carbon::now()->format('d F Y'),
                'transaction_id' => 'cod_' . $transaction_cod,
                'status' => 'delivered',
            ]);
        } else {
            $order->update([
                'delivered_date' => Carbon::now()->format('d F Y'),
                'status' => 'delivered',
            ]);
        }

        $notification = [
            'message' => 'Order delivered successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('Delivered.order.manage')->with($notification);
    }

    // Admin Invoice Download
    public function AdminOrderInvoiceDownload($id)
    {
        $orders = Order::where('id', $id)->with('user', 'division', 'district', 'state', 'OrderItem')->orderBy('id', 'DESC')->get();
        $orderItem = OrderItem::where('order_id', $id)->with('product', 'vendor')->orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('backend.order.customerInvoice', compact('orders', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot'  => public_path(),
        ]);

        $unique_invoice = Str::random(10);

        return $pdf->download('invoice_' . $unique_invoice . '.pdf');
    }
}