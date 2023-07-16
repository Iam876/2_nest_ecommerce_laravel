<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order\OrderItem;
use App\Models\Order\Order;
use APP\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderReporsManageController extends Controller
{
    public function UserOrderShow()
    {
        return view('backend.reports.userOrderSearch');
    }
    public function SearchOrderDates()
    {
        return view('backend.reports.orderByDates');
    }
    public function UserOrderInfo($search)
    {
        $id = User::where('username', $search)->first();
        $orders = Order::where('user_id', $id->id)->with('user')->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 200,
            'allData' => $orders
        ]);
    }
    public function UserOrderFullDate($fullDate)
    {
        $decodeDate = urldecode($fullDate);
        $formattedDate = Carbon::createFromFormat('d F, Y', $decodeDate)->format('d F Y');
        $orders = Order::where('order_date', $formattedDate)->with('user')->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 200,
            'allData' => $orders
        ]);
    }
    public function UserOrderMonthDate($month)
    {
        $decodeDate = urldecode($month);
        $formattedMonth = Carbon::createFromFormat('F', $decodeDate)->format('F');
        $orders = Order::where('order_month', $formattedMonth)->with('user')->get();
        return response()->json([
            'status' => 200,
            'allData' => $orders
        ]);
    }
    public function UserOrderYearDate($year)
    {
        $formattedYear = Carbon::createFromFormat('Y', $year)->format('Y ');
        $orders = Order::where('order_year', $formattedYear)->with('user')->get();
        return response()->json([
            'status' => 200,
            'allData' => $orders
        ]);
    }
}
