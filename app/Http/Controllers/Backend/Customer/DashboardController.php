<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function customerAuth(){
        $Cart = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        return view('frontend.pages.customer-auth',compact('Cart'));
    }

    public function registration(Request $request){
        $request->validate([
            'name'  =>  'required',
            'email'  =>  'required|email|unique:users,email',
            'password'  =>  'required|min:8'
        ]);

        $RoleId = Role::create([
            'name'  => 'Customer',
            'slug'  =>  'customer'
        ]);

        $Customer = User::create([
            'role_id'   =>  $RoleId->id,
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password'  =>  Hash::make($request->password),
            'status'    => 2
        ]);

        if($RoleId && $Customer){
            $notification = array(
                'message'   =>  'Your account has been success:)',
                'alert-type'    =>  'success'
            );

            return redirect()->route('customer.login')->with($notification);
        }
    }

    public function index(){
        $Cart = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        return view('frontend.pages.customer-dashboard', compact('Cart'));
    }

    public function customerLoin(){
        $Cart = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        return view('frontend.pages.customer-login',compact('Cart'));
    }


}
