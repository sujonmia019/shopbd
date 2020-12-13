<?php

namespace App\Http\Controllers\Backend\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category = Category::latest()->get();
        return view('backend.admin.category.index', compact('Category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.category.create');
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
            'name'  =>  'required|unique:categories,name'
        ]);

        $Store = new Category();
        $Store->name    =   $request->name;
        $Store->slug    =   Str::of($request->name)->slug('-');
        if(!isset($request->publish)){
            $Store->status = false;
        }
        else{
            $Store->status = true;
        } 
        $Store->save(); 

        if($Store){
            $notification = array(
                'message'   =>  'Category created successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.category.index')->with($notification);
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
        $Edit = Category::findOrFail($id);
        return view('backend.admin.category.edit', compact('Edit'));
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
            'name'  =>  'required|unique:categories,name'
        ]);

        $Update = Category::findOrFail($id);
        $Update->name    =   $request->name;
        $Update->slug    =   Str::of($request->name)->slug('-');
        if(!isset($request->publish)){
            $Update->status = false;
        }
        else{
            $Update->status = true;
        } 
        $Update->save(); 

        if($Update){
            $notification = array(
                'message'   =>  'Category updated successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Delete = Category::findOrFail($id)->delete();
        if($Delete){
            $notification = array(
                'message'   =>  'Category deleted successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.category.index')->with($notification);
    }

    // category active
    public function active($id){
        $Active = Category::findOrFail($id)->update([
            'status'    =>  '1'
        ]);

        if($Active){
            $notification = array(
                'message'   =>  'Category publish successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.category.index')->with($notification);
    }

    // category active
    public function unActive($id){
        $Unactive = Category::findOrFail($id)->update([
            'status'    =>  '0'
        ]);

        if($Unactive){
            $notification = array(
                'message'   =>  'Category pandding successfull.',
                'alert-type'    =>  'success'
            );
        }

        return redirect()->route('admin.category.index')->with($notification);
    }
}
