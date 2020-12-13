<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'user_id', 'category_id','brand_id','product_name','product_slug','product_code','product_qty','product_price','short_description','long_description','thumbnail_image','image_one','image_two','status'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    

}
