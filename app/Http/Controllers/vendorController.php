<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class vendorController extends Controller
{
    //view
    public function vendorDashboard(){
        return view('vendor.index');
    }
    // vendor login
    public function VendorLogin(){
        return view('vendor.vendorLogin');
    }
    // vendor logout
    public function vendorDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('vendor/login');
    }// end method

    // Vendor Profile
    public function vendorProfile(){
        $id = Auth::user()->id;
        $vendorData = user::find($id);
        return view('vendor.vendorProfile',compact('vendorData'));
    }
    public function vendorProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = user::findOrFail($id);

        $original = $data->getOriginal();

        $data->username = $request->username;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->join_date = $request->join_date;
        $data->short_desc = $request->short_desc;
        
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor-images/'.$data->photo));
            $fileName = date('YmHi').$file->getClientOriginalExtension();
            $file->move(public_path('upload/vendor-images/'),$fileName);
            $data['photo'] = $fileName;
        }

        $data->save();
        $changeFields = array();
        unset($original['created_at'], $original['updated_at']);

        foreach($original as $key => $value){
            if($data->$key !== $value){
                array_push($changeFields,$key);
            }
        }

        if(count($changeFields)==1){
            $notification = array(
                'message'=>'Vendor '.ucfirst($changeFields[0]).' Update Successfully',
                'alert-type'=>'success'
            );
        }
        elseif(count($changeFields)>1){
            $notification = array(
                'message'=>'Vendor Profile Update Successfully',
                'alert-type'=>'success'
            );
        }
        else{
            $notification = array(
                'message'=>'No changes were made to the Vendor profile',
                'alert-type'=>'info'
            );
        }
        return redirect()->back()->with($notification);
    }

    // Password Page Route
    public function vendorPasswordChange(){
        return view('vendor.vendorChangePassword');
    }
    public function vendorPasswordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        // Match Old Password
        if(!Hash::check($request->old_password,auth::user()->password)){
            $notification = array(
                'message' => 'Old Password Doesnt Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        if($request->new_password !== $request->confirm_password){
            $notification = array(
                'message' => 'New password & Confirm Password doesnt match',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        }

        // Update Vendor Password
        User::whereId(auth()->user()->id)->update([
            'password'=>Hash::make($request->new_password)
        ]);
        $notification = array(
            'message'=>'Password Successfully Updated',
            'alert-type'=>'success'
        );
        return back()->with($notification);

    }

    // Vendor Register Page Route
    public function BecomeVendor(){
        return view('auth.becomeVendorRegister');
    }

    // Vendor Register
    public function RegisterVendor(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        // $save_vendor_image = NULL;

        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $fileName = date('YmHi').$image->getClientOriginalExtension();
            $image->move(public_path('upload/vendor-images/'),$fileName);
            $save_vendor_image = $fileName;
        }

        $user = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $save_vendor_image,
            'join_date'=>date('Ymd'),
            'role'=>'vendor',
            'status'=>'inactive',
            'password' => Hash::make($request->password),
        ]);

        $notification = array(
            'message'=>'Registered Successfull | Please Login',
            'alert-type'=>'success'
        );

        return redirect()->route('vendor.login')->with($notification);
    }

    // Inactive Vendor

    public function InactiveVendor(){
        $InactiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('backend.vendor.inactiveVendor',compact('InactiveVendor'));
    }

    public function AddInactiveVendor($id){
        User::findOrFail($id)->update([
            'status'=>'active'
        ]);

        $notification = array([
            'message' => 'Vendor Active Successfully',
            'alert-type'=>'success'
        ]);

        return redirect()->route('active.vendor')->with($notification);
    }

    // Active Vendor 
    public function ActiveVendor(){
        $ActiveVendor = User::where('role','vendor')->where('status','active')->latest()->get();
        return view('backend.vendor.activeVendor',compact('ActiveVendor'));
    }

    public function AddActiveVendor($id){
        User::findOrFail($id)->update([
            'status'=>'inactive'
        ]);
        $notification = array([
            'message'=>'Vendor Inactive Successfully',
            'alert-type'=>'success'
        ]);

        return redirect()->route('inactive.vendor')->with($notification);
    }
}
