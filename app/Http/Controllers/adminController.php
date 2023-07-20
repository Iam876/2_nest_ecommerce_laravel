<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    //Dashboard view
    public function adminDashboard()
    {
        return view('admin.index');
    } // end method

    // Login Method
    public function AdminLogin()
    {
        return view('admin.adminLogin');
    } // end method
    // Logout Method
    public function adminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    } // end method

    // Admin Profile
    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = user::find($id);
        return view('admin.adminProfile', compact('adminData'));
    } // end method
    // Admin Profile Update
    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = user::find($id);

        $original = $data->getOriginal();

        $data->username = $request->username;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin-images/' . $data->photo));
            $fileName = date('YmHi') . $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin-images'), $fileName);
            $data['photo'] = $fileName;
        }
        $data->save();
        $changeFields = array();
        unset($original['created_at'], $original['updated_at']);

        foreach ($original as $key => $value) {
            if ($data->$key !== $value) {
                array_push($changeFields, $key);
            }
        }

        if (count($changeFields) == 1) {
            $notification = array(
                'message' => 'Admin ' . ucfirst($changeFields[0]) . ' Update Successfully',
                'alert-type' => 'success'
            );
        } elseif (count($changeFields) > 1) {
            $notification = array(
                'message' => 'Admin Profile Update Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'No changes were made to the admin profile',
                'alert-type' => 'info'
            );
        }
        return redirect()->back()->with($notification);
    } // end method

    // Admin Password Page
    public function adminPasswordChange()
    {
        return view('admin.adminChangePassword');
    } // end method

    // Admin Password Update
    public function adminPasswordUpdate(Request $request)
    {
        // validation
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
            return back()->with($notification);
        }
        if ($request->new_password !== $request->confirm_password) {
            $notification = array(
                'message' => 'New password & Confirm Password doesnt match',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        }

        // Update The new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Successfully Updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    } // end method


    // ################ Multiple Role Management ################### //

    public function AllAdmin()
    {
        $alladminuser = User::where('role', 'admin')->latest()->get();
        return view('backend.adminManage.all_admin', compact('alladminuser'));
    }

    public function AddAdmin()
    {
        $roles = Role::all();
        return view('backend.adminManage.add_admin', compact('roles'));
    }


    public function AdminUserStore(Request $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdminRole($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.adminManage.edit_admin', compact('user', 'roles'));
    } // End Mehtod 


    public function AdminUserUpdate(Request $request, $id)
    {


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // End Mehtod 

    public function DeleteAdminRole($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
