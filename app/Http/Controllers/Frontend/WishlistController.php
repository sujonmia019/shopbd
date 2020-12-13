<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //Add Wishlist
    public function addWishlist($id){
        
        if(Auth::check()){
            $check = Wishlist::where('product_id',$id)->first();
            if($check){
                $notification = array(
                    'message'   =>  'Product already on wishlist!',
                    'alert-type'    =>  'error'
                );

                return redirect()->back()->with($notification);
            }
            else{
                $Wishlist = Wishlist::create([
                    'product_id'    =>  $id,
                    'user_id'       =>  Auth::user()->id
                ]);

                if($Wishlist){
                    $notification = array(
                        'message'   =>  'Product added on wishlist!',
                        'alert-type'    =>  'success'
                    );
    
                    return redirect()->back()->with($notification);
                }
            }
            
        }
        else{
            $notification = array(
                'message'   =>  'At first login your account!',
                'alert-type'    =>  'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    // Wishlist Page 
    public function wishlist(){
        $Category = Product::latest()->where('status',1)->select('category_id')->groupBy('category_id')->get();
        $Wishlists = Wishlist::where('user_id', Auth::id())->latest()->get();
        return view('frontend.pages.wishlist', compact('Category','Wishlists'));
    }

    // Wishlist Destroy 
    public function destroy($id){
        $Delete = Wishlist::where('id',$id)->where('user_id', Auth::user()->id)->delete();

        if($Delete){
            $notification = array(
                'message'   =>  'Wishlist product remove!',
                'alert-type'    =>  'success'
            );

            return redirect()->back()->with($notification);
        }

    }
}
