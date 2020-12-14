<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class OrderController extends Controller
{
    public function orderStore(Request $request){

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:shippings,email',
            'order_note'    =>  'required'
        ]);

        $orderId = Order::insertGetId([
            'user_id'   =>  Auth::id(),
            'invoice_no'    =>  mt_rand(100000, 999999),
            'payment'   =>  $request->payment_type,
            'total'     =>  $request->total,
            'subtotal'  =>  $request->subtotal,
            'coupon_discount'    =>  $request->coupon_discount,
            'created_at'    =>  Carbon::now()
        ]);

        $cart = Cart::where('user_ip', request()->ip())->latest()->get();
        foreach($cart as $item){
           OrderDetails::create([
                'order_id'  =>  $orderId,
                'product_id'    =>  $item->product_id,
                'product_qty'   =>  $item->qty
            ]);
        }

        $shipping = Shipping::create([
            'order_id' => $orderId,
            'fname' =>  $request->first_name,
            'lname' => $request->last_name,
            'address'   =>  $request->address,
            'city'  =>  $request->city,
            'state' =>  $request->state,
            'postcode'  =>  $request->postcode,
            'phone' =>  $request->phone,
            'email' =>  $request->email,
            'order_note'    =>  $request->order_note
        ]);

        if(Session()->has('coupon')){
            session()->forget('coupon');
        }
        Cart::where('user_ip',request()->ip())->delete();

        if($orderId && $shipping){
            $notification = array([
                'message'   => 'Your order completed',
                'alert-type'    =>  'success'
            ]);

            return redirect()->route('customer.dashboard')->with($notification);
        }

    }

    // Customer Order Page
    public function orderAll(){
        $Cart = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        $Order = Order::where('user_id', Auth::user()->id)->get();
        return view('frontend.pages.orders', compact('Cart','Order'));
    }

    // Order view
    public function orderView($id){
        $Cart = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        $Order = Order::findOrFail($id);
        $OrderDetails = OrderDetails::with('product')->where('order_id', $id)->get();
        $Shipping = Shipping::where('order_id', $id)->first();
        return view('frontend.pages.order-view', compact('Cart','Order','OrderDetails','Shipping'));
    }

}
