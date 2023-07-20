<?php

namespace App\Http\Controllers\Frontend\Shipping;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use App\Models\Shipping\shippingDistrict;
use App\Models\Shipping\shippingState;

class ShippingProductController extends Controller
{
    //

    public function GetDistrict($id){
        $districts = shippingDistrict::where('division_id',$id)->orderBy('district_name','ASC')->get();
        // return response()->json
        return json_encode($districts);
    }

    public function GetState($id){
        $state = shippingState::where('district_id',$id)->orderBy('state_name','ASC')->get();
        // return response()->json
        return json_encode($state);
    }

    public function CheckoutStorePayment(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_post_code'] = $request->shipping_post_code;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_message'] = $request->shipping_message;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        
        $cartTotal = Cart::getTotal();

        if($request->payment_option == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }
        else if($request->payment_option == 'bank'){
            return view('frontend.payment.bank',compact('data','cartTotal'));
        }
        else{
            return view('frontend.payment.cash',compact('data','cartTotal'));
        }
    }
}
