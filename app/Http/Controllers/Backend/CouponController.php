<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    public function AllCoupon(){
        return view('backend.coupon.coupon');
    }
    public function AddCoupon(Request $request){

        $validity = $request->validity;
        $expiryDate = Carbon::now()->add($validity);
        $formattedExpiryDate = $expiryDate->format('Y-m-d H:i:s');

        $coupon = Coupon::insert([
            'coupon_name'=>$request->name,
            'coupon_discount'=>$request->discount,
            'coupon_validity'=>$formattedExpiryDate,
            'coupon_status'=>$request->status,
            'created_at'=>Carbon::now(),
        ]);
        return response()->json(['success'=>'Coupon Added Successfully']);
    }

    public function ShowCoupon(){
        $coupon = Coupon::latest()->get();
        return response()->json([
            'status' => 200,
            'AllData' => $coupon
        ]);
    }

    public function InactiveCoupon($id){
       $coupon = Coupon::findOrFail($id);
       $coupon->update(['coupon_status'=>'inactive']);

       return response()->json(['success'=>'coupon Inactive successfully']);
    }
    public function ActiveCoupon($id){
       $coupon = Coupon::findOrFail($id);
       $coupon->update(['coupon_status'=>'active']);

       return response()->json(['success'=>'coupon Active successfully']);
    }

    public function DeleteCoupon($id){
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return response()->json(['success'=>'coupon Deleted successfully']);
    }

    public function EditCoupon($id){
        $coupon = Coupon::findOrFail($id);
        return response()->json(['success'=>$coupon]);
    }

    public function UpdateCoupon(Request $request,$id){
        $coupon = Coupon::findOrFail($id);
        $validity = $request->validity;
        $expiryDate = Carbon::now()->add($validity);
        $formattedExpiryDate = $expiryDate->format('Y-m-d H:i:s');

        $coupon->update([
            'coupon_name'=>$request->name,
            'coupon_discount'=>$request->discount,
            'coupon_validity'=>$formattedExpiryDate,
            'coupon_status'=>$request->status,
            'created_at'=>Carbon::now()
        ]);

        return response()->json(['success'=>'Coupon Successfully Updated']);
    }
}


