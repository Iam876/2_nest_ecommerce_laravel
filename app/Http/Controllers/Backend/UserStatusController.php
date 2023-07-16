<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserStatusController extends Controller
{
    public function NormalUsersStatus()
    {
        $active_user = User::where('role', 'user')->where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('backend.userStatus.allUsers', compact('active_user'));
    }
    public function VendorStatus()
    {
        $active_vendors = User::where('role', 'vendor')->where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('backend.userStatus.allVendors', compact('active_vendors'));
    }
    // public function UsersStatus()
    // {

    // }
}