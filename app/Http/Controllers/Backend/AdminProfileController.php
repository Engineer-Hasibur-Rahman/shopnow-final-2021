<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminProfileController extends Controller
{

    // admin profile view
    public function AdminProfile(){

        $adminData = Admin::find(1);

        return view('admin.admin_profile_view', compact('adminData'));
    }


    // admin profile edit 
    public function AdminProfileEdit(){

        $editData = Admin::find(1);

        return view('admin.admin_profile_edit', compact('editData'));
    }


    // admin profile Update
    public function AdminProfileStore(Request $request)
    {
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
// update sms
        $notification = array(
            'message' =>  'Admin Profie Update Sucessyfuly',
            'alert-type' => 'success'
        ); 
        return redirect()->route('admin.admin_profile_view')->with($notification);
    }


     public function AdminChangePassword(){

            return view('admin.admin_change_password');

     }

        // admin password update
    public function AdminUpdateChangePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Admin::find(1)->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
        $admin = Admin::find(1);
        $admin->password = Hash::make($request->password);
        $admin->save();
        Auth::logout();
        return redirect()->route('admin.logout');

        }else{
            return redrrect()->back();
        }


    } // main method end






}
