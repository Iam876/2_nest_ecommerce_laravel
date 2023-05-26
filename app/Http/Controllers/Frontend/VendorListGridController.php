<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorListGridController extends Controller
{
    //
    public function VendorList(){
        $user = User::where('role','vendor')->where('status','active')->paginate(16);
        // $currentPage = $user->currentPage();
        return view('frontend.vendorListGrid',compact('user'));
    }
}
