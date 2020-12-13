<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $Category = Product::orderby('id','DESC')->select('category_id')->groupBy('category_id')->where('status',1)->get();
        return view('frontend.pages.index', compact('Category'));
    }

    
}
  