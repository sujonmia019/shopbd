<?php

namespace App\Http\Controllers\Backend\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Product = Product::with('category','brand')->latest()->get();
        return view('backend.admin.product.index', compact('Product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Category = Category::where('status',1)->latest()->get();
        $Brand = Brand::where('status',1)->latest()->get();
        return view('backend.admin.product.create', compact('Category','Brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Product input validation
    	$request->validate([
    		'product_name'		=>	'required|unique:products,product_name',
    		'product_code'		=>	'required',
    		'product_price'		=>	'required',
    		'product_quantity'	=>	'required',
    		'category'			=>	'required',
    		'brand'				=>	'required',
    		'short_description'	=>	'required',
    		'long_description'	=>	'required',
    		'image_thumbnail'	=>	'required|mimes:jpg,png,jpeg',
    		'image_gallery_one'	=>	'required|mimes:jpg,png,jpeg',
    		'image_gallery_two'	=>	'required|mimes:jpg,png,jpeg'
        ]);
        
        
        // Product image upload file
    	$thumbnail = $request->file('image_thumbnail');
    	$img = md5(time().uniqid()).'.'.$thumbnail->getClientOriginalExtension();
    	Image::make($thumbnail)->resize(270,270)->save(public_path('backend/img/product/').$img);

    	$img_gallery = $request->file('image_gallery_one');
    	$image = md5(time().uniqid()).'.'.$img_gallery->getClientOriginalExtension();
    	Image::make($img_gallery)->resize(270,270)->save(public_path('backend/img/product/').$image);

    	$image_gallerys = $request->file('image_gallery_two');
    	$images = md5(time().uniqid()).'.'.$image_gallerys->getClientOriginalExtension();
    	Image::make($image_gallerys)->resize(270,270)->save(public_path('backend/img/product/').$images);

        // Product Create in database
        if(isset($request->publish)){
            $status = 1;
        }
        else{
            $status = 0;
        }

    	$Product = Product::create([
            'user_id'           => Auth::user()->id,
    		'category_id'		=> $request->category,
			'brand_id'			=> $request->brand,
			'product_name'		=> $request->product_name,
			'product_slug'		=> Str::of($request->product_name)->slug('-'),
			'product_code'		=> $request->product_code,
			'product_qty'	    => $request->product_quantity,
			'product_price'		=> $request->product_price,
			'short_description'	=> $request->short_description,
			'long_description'	=> $request->long_description,
			'thumbnail_image'	=> $img,
			'image_one'			=> $image,
            'image_two'		    => $images,
            'status'            => $status
    	]);

    	// Confirm Message
    	if ($Product) {
            $notification = array(
                'message' => 'Product created successfull !',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product.index')->with($notification);
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
        $Edit = Product::findOrFail($id);
        $Category = Category::latest()->get();
        $Brand  =   Brand::latest()->get();
        return view('backend.admin.product.edit', compact('Edit','Category','Brand'));
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
        // Validation
    	$request->validate([
    		'product_name'		=>	'required',
    		'product_code'		=>	'required',
    		'product_price'		=>	'required',
    		'product_quantity'	=>	'required',
    		'category'			=>	'required',
    		'brand'				=>	'required',
    		'short_description'	=>	'required',
    		'long_description'	=>	'required'
        ]);

        // Old Image
    	$thumbnail_one = $request->one_thum_old;
    	$thumbnail_two = $request->two_thum_old;
        $thumbnail_three = $request->three_thum_old;

        if(isset($request->image_thumbnail) && isset($request->image_gallery_one) && isset($request->image_gallery_two)){

            // Old Image delete
            unlink(public_path('backend/img/product/').$thumbnail_one);
            unlink(public_path('backend/img/product/').$thumbnail_two);
            unlink(public_path('backend/img/product/').$thumbnail_three);

            // Product image upload file
            $thumbnail = $request->file('image_thumbnail');
            $img = md5(time().uniqid()).'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(270,270)->save(public_path('backend/img/product/').$img);

            $img_gallery = $request->file('image_gallery_one');
            $image = md5(time().uniqid()).'.'.$img_gallery->getClientOriginalExtension();
            Image::make($img_gallery)->resize(270,270)->save(public_path('backend/img/product/').$image);

            $image_gallerys = $request->file('image_gallery_two');
            $images = md5(time().uniqid()).'.'.$image_gallerys->getClientOriginalExtension();
            Image::make($image_gallerys)->resize(270,270)->save(public_path('backend/img/product/').$images);

            Product::find($id)->update([
                'thumbnail_image'	=> $img,
                'image_one'			=> $image,
                'image_two'		    => $images,
            ]);

        }
        else{
            Product::find($id)->update([
                'thumbnail_image'	=> $thumbnail_one,
                'image_one'			=> $thumbnail_two,
                'image_two'		    => $thumbnail_three
            ]);
        }

        // Product Create in database
        if(isset($request->publish)){
            $status = 1;
        }
        else{
            $status = 0;
        }

    	// Product Update
    	$ProductUpdate = Product::find($id)->update([
    		'user_id'           => Auth::user()->id,
    		'category_id'		=> $request->category,
			'brand_id'			=> $request->brand,
			'product_name'		=> $request->product_name,
			'product_slug'		=> Str::of($request->product_name)->slug('-'),
			'product_code'		=> $request->product_code,
			'product_qty'	    => $request->product_quantity,
			'product_price'		=> $request->product_price,
			'short_description'	=> $request->short_description,
			'long_description'	=> $request->long_description,
            'status'            => $status
    	]);

    	// Confirm Message
    	if ($ProductUpdate) {
            $notification = array(
                'message' => 'Product updated successfull !',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product.index')->with($notification);
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
    	// Find image name
    	$image = Product::find($id);
    	$one = $image->thumbnail_image;
    	$two = $image->image_one;
        $three = $image->image_two;
        
    	$del = unlink(public_path('backend/img/product/').$one);
    	$del = unlink(public_path('backend/img/product/').$two);
    	$del = unlink(public_path('backend/img/product/').$three);

    	$Delete = Product::find($id)->delete();
    	// Confirm Message
    	if ($del && $Delete) {
            $notification = array(
                'message' => 'Product deleted successfull !',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product.index')->with($notification);
        }
    }

    // product publish 
    public function publish($id){
        $Publish = Product::findOrFail($id)->update([
            'status'    =>   1
        ]);

        // Confirm Message
    	if ($Publish) {
            $notification = array(
                'message' => 'Product published successfull !',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product.index')->with($notification);
        }
    }

    // product pending 
    public function pending($id){
        $Pending = Product::findOrFail($id)->update([
            'status'    =>   0
        ]);

        // Confirm Message
    	if ($Pending) {
            $notification = array(
                'message' => 'Product pending successfull !',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product.index')->with($notification);
        }
    }

}
