<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    //Dahboard View
    public function UserDashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('/index', compact('userData'));
    }
    // logout
    public function UserDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
    } // end method

    public function UserPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);
        // Match Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Doesnt Match!',
                'alert-type' => 'error'
            );
            // dd($notification);
            return back()->with($notification);
        }
        if ($request->new_password !== $request->confirm_password) {
            $notification = array(
                'message' => 'New password & Confirm Password doesnt match',
                'alert-type' => 'warning'
            );
            // dd($notification);
            return back()->with($notification);
        }
        // Update Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Successfully Updated',
            'alert-type' => 'success'
        );
        // dd($notification);
        return back()->with($notification);
    }
}
