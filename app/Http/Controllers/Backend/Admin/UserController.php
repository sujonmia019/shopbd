<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::latest()->get();
        return view('backend.admin.user.index', compact('User'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.user.create');
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
            'name'  =>  'required',
            'email' =>  'required|email|unique:users,email',
            'user_type' =>  'required',
            'password'  =>  'required|min:8',
            'confirm_password'  =>  'required_with:password|same:password|min:8'
        ]);

        $Role = Role::create([
            'name'  =>  $request->user_type,
            'slug'  =>  Str::of($request->user_type)->slug('-')
        ]);

        $Store = User::create([
            'role_id'   =>  $Role->id,
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password' =>  Hash::make($request->password),
            'status'    =>  '0'
        ]);
        
        // confirm message 
        Mail::send('backend.mail.usermail', [
            'name'  =>  $request->name,
            'email' =>  $request->email,
        ], function($mail)use($request){
            $mail->from('sujonbdjoin019@gmail.com','ShopBD');
            $mail->to($request->email)->subject('Welcome');
        });

        if($Store){
            $notification = array(
                'message' => 'User created successfully!',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('admin.user.index')->with($notification);

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
        
        $Edit = User::findOrFail($id);
        return view('backend.admin.user.edit', compact('Edit'));
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
        // $request->validate([
        //     'name'  =>  'required',
        //     'email' =>  'required|email|unique:users,email',
        //     'user_type' =>  'required'
        // ]);

        // $Role = Role::findOrFail($id)->update([
        //     'name'  =>  $request->user_type,
        //     'slug'  =>  Str::of($request->user_type)->slug('-')
        // ]);

        // $Updated = User::findOrFail($id)->update([
        //     'name'  =>  $request->name,
        //     'email' =>  $request->email
        // ]);

        // return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Delete = User::findOrFail($id)->delete();
        if($Delete){
            $notification = array(
                'message' => 'User deleted successfully!',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('admin.user.index')->with($notification);
    }

    // user active 
    public function active($id){
        $Active = User::findOrFail($id)->update([
            'status'    =>  '1'
        ]);

        return redirect()->back();
    }

    // user unactive 
    public function unActive($id){
        $Unactive = User::findOrFail($id)->update([
            'status'    =>  '0'
        ]);

        return redirect()->back();

    }
}
