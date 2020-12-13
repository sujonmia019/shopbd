<?php

namespace App\Http\Controllers\Backend\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Brand = Brand::latest()->get();
        return view('backend.admin.brand.index', compact('Brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.brand.create');
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
            'name'  =>  'required|unique:brands,name'
        ]);

        $Store = new Brand();
        $Store->name    =   $request->name;
        if(!isset($request->publish)){
            $Store->status = 0;
        }
        else{
            $Store->status = 1;
        } 
        $Store->save(); 

        if($Store){
            $notification = array(
                'message'   =>  'Brand created successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.brand.index')->with($notification);
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
        $Edit = Brand::findOrFail($id);
        return view('backend.admin.brand.edit', compact('Edit'));
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
        $request->validate([
            'name'  =>  'required|unique:brands,name'
        ]);

        $Update = Brand::findOrFail($id);
        
        $Update->name    =   $request->name;
        if(!isset($request->publish)){
            $Update->status = 0;
        }
        else{
            $Update->status = 1;
        } 
        $Update->save(); 

        if($Update){
            $notification = array(
                'message'   =>  'Brand updated successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.brand.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Delete = Brand::findOrFail($id)->delete();
        if($Delete){
            $notification = array(
                'message'   =>  'Brand deleted successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.brand.index')->with($notification);
    }

     // Brand active
     public function publish($id){
        $Publish = Brand::findOrFail($id)->update([
            'status'    =>  '1'
        ]);

        if($Publish){
            $notification = array(
                'message'   =>  'Brand publish successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.brand.index')->with($notification);
    }

    // Brand active
    public function pending($id){
        $Pending = Brand::findOrFail($id)->update([
            'status'    =>  '0'
        ]);

        if($Pending){
            $notification = array(
                'message'   =>  'Brand pandding successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.brand.index')->with($notification);
    }
}
