<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Http\Request;

class VendorDetailsController extends Controller
{
    //
    public function VendorDetails($id){
        $user = User::findOrFail($id);
        $products = Product::where('vendor_id',$id)->where('status',1)->orderBy('product_name','DESC')->paginate(5);
        return view('frontend.vendorDetailsPage',compact('user','products'));
    }
}
