<?php

namespace App\Http\Controllers\Backend\Admin\Profile;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $User = Auth::user();
        return view('backend.admin.profile.index', compact('User'));
    }

    public function update(Request $request){

        $UserUpdate = Auth::user();
        $images = $UserUpdate->image;

        $request->validate([
            'name'          =>  'required',
            'phone'         =>  'required|unique:users,phone',
            'your_bio'      =>  'required',
            'profile_image' =>  'required|mimes:jpg,png'
        ]);


        if($images){
            unlink(public_path('backend/img/profile/'.$images));

            if($request->hasFile('profile_image')){
                $img = $request->file('profile_image');
                $imageName = $request->name.'-'.md5(time()).'.'.$img->getClientOriginalExtension();
                $img->move(public_path('backend/img/profile/'), $imageName);
            }
            
            $Update = User::where('id', $UserUpdate->id)->update([
                'name'          => $request->name,
                'phone'         => $request->phone,
                'about'         => $request->your_bio,
                'image'         => $imageName
            ]);

            if($Update){
                $notification = array(
                    'message'       =>  'Your profile updated successfull.',
                    'alert-type'    =>  'success'
                );
            }
            return redirect()->route('admin.profile.index')->with($notification);

        }

    }

    // password change 
    public function password(){
        $User = Auth::user();
        return view('backend.admin.profile.password', compact('User'));
    }

    // password store 
    public function store(Request $request){
        $UserId = Auth::user()->id;
        $Password = Auth::user()->password;

        $request->validate([
            'old_password'  =>  'required',
            'new_password'  =>  'required|min:8|max:16',
            'confirm_password'  => 'required_with:new_password|same:new_password'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        if(Hash::check($old_password, $Password)){
            $PasswordChange = User::find($UserId)->update([
                'password'  =>  Hash::make($new_password)
            ]);
            Auth::logout();
            if($PasswordChange){
                $notification = array(
                    'message'       =>  'Password Updated Successfull !',
                    'alert-type'    =>  'success'
                );
            }
            return redirect()->route('login')->with($notification);
        }
        else{
            $notification = array(
                'message'       =>  'Old password does not match !',
                'alert-type'    =>  'error'
            );
            return redirect()->route('admin.password')->with($notification);
        }
    }

}
