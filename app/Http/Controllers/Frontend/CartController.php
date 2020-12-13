<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //add to cart
    public function addCart(Request $request, $id){
        $check = Cart::where('product_id',$id)->where('user_ip',request()->ip())->first();
        if($check){
           $cart = Cart::where('product_id',$id)->where('user_ip',request()->ip())->increment('qty');
           if($cart){
               $notification = array(
                    'message'   =>  'Product added on cart!',
                    'alert-type'=>  'success'
               );
           }
           return redirect()->back()->with($notification);
        }else{
            $AddCart = Cart::create([
                'product_id'    =>  $id,
                'qty'           =>  1,
                'price'         =>  $request->price,
                'user_ip'       =>  request()->ip()
            ]);
            if($AddCart){
                $notification = array(
                     'message'   =>  'Product added on cart!',
                     'alert-type'=>  'success'
                );
            }
            return redirect()->back()->with($notification);
        }

    }


    // cart details
    public function Cart(){
        $Cart = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        $cartProduct = Cart::where('user_ip',request()->ip())->latest()->get();
        $subTotal = Cart::all()->where('user_ip',request()->ip())->sum(function($t){
            return $t->price * $t->qty;
        });
        return view('frontend.pages.cart', compact('Cart','cartProduct','subTotal'));
    }

    // cart destroy
    public function destroy($id){
        $Destroy = Cart::where('id',$id)->where('user_ip',request()->ip())->delete();
        if($Destroy){
            $notification = array(
                 'message'   =>  'Cart deleted successfull.',
                 'alert-type'=>  'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    // cart update
    public function update(Request $request, $id){
        $Update = Cart::where('id',$id)->where('user_ip',request()->ip())->update([
            'qty'   =>  $request->qty
        ]);

        if($Update){
            $notification = array(
                 'message'   =>  'Cart updated successfull.',
                 'alert-type'=>  'success'
            );
            return redirect()->back()->with($notification);
        }

    }

    // cart coupon
    public function coupon(Request $request){
        $Check = Coupon::where('name', $request->coupon)->where('status',1)->first();
        if($Check){
            $subTotal = Cart::all()->where('user_ip',request()->ip())->sum(function($t){
                return $t->price * $t->qty;
            });

            Session::put('coupon',[
                'name'  =>  $Check->name,
                'discount'  =>  $Check->discount,
                'discount_amount'   =>  $subTotal * ($Check->discount/100)
            ]);

            $notification = array(
                'message'   =>  'Successfull coupon apply!',
                'alert-type'=>  'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message'   =>  'Does not coupon apply?',
                'alert-type'=>  'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    // product details
    public function productDetails($slug){
        $Category = Product::latest()->where('status',1)->select('category_id')->groupBy('category_id')->get();
        $Product = Product::where('product_slug', $slug)->first();
        $Category_id = $Product->category_id;
        $Releted_Product = Product::latest()->where('category_id', $Category_id)->where('product_slug','!=',$slug)->get();
        return view('frontend.pages.product-details', compact('Category','Product','Releted_Product'));
    }

    // product added on cart
    public function add_to_cart(Request $request, $id){
        $check = Cart::where('product_id',$id)->where('user_ip',request()->ip())->first();
        if($check){
           $cart = Cart::where('product_id',$id)->where('user_ip',request()->ip())->increment('qty');
           if($cart){
               $notification = array(
                    'message'   =>  'Product added on cart!',
                    'alert-type'=>  'success'
               );
           }
           return redirect()->route('product.cart')->with($notification);
        }else{
            $AddCart = Cart::create([
                'product_id'    =>  $id,
                'qty'           =>  $request->qty,
                'price'         =>  $request->price,
                'user_ip'       =>  request()->ip()
            ]);
            if($AddCart){
                $notification = array(
                     'message'   =>  'Product added on cart!',
                     'alert-type'=>  'success'
                );
            }
            return redirect()->route('product.cart')->with($notification);
        }
    }

    // coupon destroy
    public function couponDestroy(){
        if(Session::has('coupon')){
            Session::forget('coupon');
            $notification = array(
                    'message'   =>  'Coupon remove successfull!',
                    'alert-type'=>  'success'
            );
            return redirect()->back()->with($notification);
        }
    }




}
