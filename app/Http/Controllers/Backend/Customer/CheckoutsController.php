<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutsController extends Controller
{
    // Checkout index
    public function checkOut(){
        $Cart = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        $cartProduct = Cart::where('user_ip',request()->ip())->latest()->get();
        $subTotal = Cart::all()->where('user_ip',request()->ip())->sum(function($t){
            return $t->price * $t->qty;
        });
        if(Auth::check()){
            return view('frontend.pages.checkout', compact('Cart','cartProduct','subTotal'));
        }
        else{
            return view('frontend.pages.customer-login');
        }
    }
}
