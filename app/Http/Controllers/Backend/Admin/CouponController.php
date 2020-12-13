<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Coupon = Coupon::latest()->get();
        return view('backend.admin.coupon.index', compact('Coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name'  =>  'required|unique:coupons,name',
            'discount'      =>  'required'
        ]);

        if(isset($request->publish)){
            $status = 1;
        }
        else{
            $status = 0;
        }

        $Coupon = Coupon::create([
            'name'  =>  $request->coupon_name,
            'discount'  =>  $request->discount,
            'status'    =>  $status
        ]);

        if($Coupon){
            $notification = array(
                'message'   =>  'Coupon created successfull !',
                'alert-type'    =>  'success'
            );

            return redirect()->route('admin.coupon.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Edit = Coupon::findOrFail($id);
        return view('backend.admin.coupon.edit', compact('Edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request->publish)){
            $status = 1;
        }
        else{
            $status = 0;
        }

        $Update = Coupon::findOrFail($id)->update([
            'name'  =>  $request->coupon_name,
            'discount'  =>  $request->discount,
            'status'    =>  $status
        ]);

        if($Update){
            $notification = array(
                'message'   =>  'Coupon updated successfull !',
                'alert-type'    =>  'success'
            );

            return redirect()->route('admin.coupon.index')->with($notification);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Delete = Coupon::findOrFail($id)->delete();

        if($Delete){
            $notification = array(
                'message'   =>  'Coupon deleted successfull !',
                'alert-type'    =>  'success'
            );

            return redirect()->route('admin.coupon.index')->with($notification);
        }
    }

    // coupon publish 
    public function publish($id){
        $Publish = Coupon::findOrFail($id)->update([
            'status'    =>   1
        ]);

        if($Publish){
            $notification = array(
                'message'   =>  'Coupon published successfull !',
                'alert-type'    =>  'success'
            );

            return redirect()->route('admin.coupon.index')->with($notification);
        }
    }

    // coupon publish 
    public function pending($id){
        $Pending = Coupon::findOrFail($id)->update([
            'status'    =>   0
        ]);

        if($Pending){
            $notification = array(
                'message'   =>  'Coupon pending successfull !',
                'alert-type'    =>  'success'
            );

            return redirect()->route('admin.coupon.index')->with($notification);
        }
    }

}
